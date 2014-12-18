
/**
 * @category  Fishpig
 * @package  Fishpig_Wordpress
 * @license    http://fishpig.co.uk/license.txt
 * @author     Ben Tideswell <ben@fishpig.co.uk>
 */

var FP_DEV_PREFILL = false;

var CF7 = Class.create({
	initialize: function(formId){
		this.form = $(formId);

		if (!this.form) {
			return;
		}

		this.validator  = new Validation(this.form);
		this.form.observe('submit', this.submit.bindAsEventListener(this));
		
		if (FP_DEV_PREFILL) {
			this.form.select('input,textarea').each(function(elem, ind) {
				if (elem.hasClassName('validate-email')) {
					elem.setValue('test@test.com');
				}
				else if (elem.readAttribute('type') != 'file' && elem.readAttribute('type') != 'hidden') {
					elem.setValue('Hello! ' + Math.floor(Math.random()*9000));
				}
			});
		}
			
		if (this.hasUploadFields()) {
			this.ifm = new Element('iframe', {
				'id': formId + '-iframe',
				 'name': formId + '-iframe', 
				 'style': 'display:none;'
			});
			
			this.form.writeAttribute('target', this.ifm.name)
				.insert({'bottom': this.ifm});
				
			this.ifm.observe('load', this.iframeOnLoad.bindAsEventListener(this));
		}
	},
	hasUploadFields: function() {
		return this.form.readAttribute('enctype') === 'multipart/form-data';
	},
	submit : function(event) {
		if (this.hasUploadFields()) {
			if (!this.validator.validate()) {
				Event.stop(event);
				return false;
			}
		
			return true;
		}

		Event.stop(event);

		if (!this.validator.validate()) {
			return false;
		}

		this.form.request({
			parameters: this.form.serialize(),
			onComplete: function(transport){
				this.onSentOkay(transport);
			}.bind(this)
		});
	},
	onSentOkay: function(transport) {

		var json = transport.responseText.evalJSON();
		var msg = new Array(json.message);
		
		if (json.invalids) {
			if (json.onSubmit) {
				eval(json.onSubmit);
				
				if (typeof Recaptcha != 'undefined') {
					Recaptcha.reload();
				}
			}

			for(var i = 0; i < json.invalids.length; i++) {
				if (json.invalids[i].message) {
					msg.push('- ' + json.invalids[i].message);
				}
			}
		}

		alert(msg.join("\n"));
	},
	iframeOnLoad: function(event) {
		var tareas = (this.ifm.contentDocument || this.ifm.contentWindow.document)
			.body
			.getElementsByTagName('textarea');

		if (tareas.length > 0) {
			this.onSentOkay({
				'responseText': tareas[0].innerHTML
			});
		}
	}
});
