<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_Wordpress_Post_CommentController extends Fishpig_Wordpress_Controller_Abstract
{
	/**
	 * Post a comment action
	 *
	 */
	public function postAction()
	{
		if ($this->isEnabledForStore()) {
			$challenge = $this->getRequest()->getPost('recaptcha_challenge_field');
			$field = $this->getRequest()->getPost('recaptcha_response_field');

			if ($post = $this->getPost()) {
				$data = new Varien_Object($this->getRequest()->getPost());
	
				try {
					Mage::getSingleton('wordpress/session')->setPostCommentData($post, $data->getAuthor(), $data->getEmail(), $data->getUrl(), $data->getComment());
					
					if (Mage::helper('wordpress/plugin_recaptcha')->isEnabled()) {
						if (!Mage::helper('wordpress/plugin_recaptcha')->isValidValue($challenge, $field, true)) {
							throw new Exception($this->getCaptchaErrorMessage());
						}
					}
	
					$comment = $post->postComment($data->getAuthor(), $data->getEmail(), $data->getUrl(), $data->getComment(), $data->getExtra());
					
					if (!$comment) {
						throw new Exception($this->getCommentErrorMessage());		
					}
		
					Mage::getSingleton('wordpress/session')->removePostCommentData($post);
					Mage::getSingleton('core/session')->addSuccess($this->__($this->getCommentSuccessMessage()));
				}
				catch (Exception $e) {
					Mage::getSingleton('core/session')->addError($this->__($e->getMessage()));
				}
		
				$this->_redirectUrl($post->getPermalink());
			}
			else {
				$this->_forward('noRoute');
			}
		}
		else {
			$this->_forward('noRoute');
		}
	}
	
	/**
	 * Return the post model that this comment is aimed for
	 *
	 * @return Fishpig_Wordpress_Model_Post
	 */
	public function getPost()
	{
		$objectType = $this->getRequest()->getParam('is_page', false) ? 'wordpress/page' : 'wordpress/post';
		
		$post = Mage::getModel($objectType)->load($this->getRequest()->getPost('comment_post_ID'));
		
		return $post->getId() > 0 ? $post : false;
	}

	/**
	 * Retrieve the success message for an invalid comment
	 *
	 * @return string
	 */	
	public function getCommentSuccessMessage()
	{
		return Mage::getStoreConfig('wordpress_blog/posts/comment_success_msg');
	}
	
	/**
	 * Retrieve the error message for an invalid comment
	 *
	 * @return string
	 */
	public function getCommentErrorMessage()
	{
		return Mage::getStoreConfig('wordpress_blog/posts/comment_error_msg');
	}
	
	/**
	 * Retrieve the error message used for an invali captcha code
	 *
	 * @return string
	 */
	public function getCaptchaErrorMessage()
	{
		return Mage::getStoreConfig('wordpress_blog/recaptcha/error_msg');
	}
}
