var VideoHandler = {
  index: 0,
  videos: [],
  populate: function (videos) {
    this.videos = videos;
  },
  next: function () {
    this.index += 1;
    if (this.index === this.videos.length ){
      this.index = 0;
    }
    return this.videos[this.index];
  },
  prev: function () {
	this.index--;
    if (this.index < 0 ){
      this.index = this.videos.length-1;
    }
    return this.videos[this.index];
  },
  getCurrent: function () {
    return this.videos[this.index];
  },
  getFirst: function () {
    return this.videos[0];
  },
  getLast: function () {
    return this.videos[this.videos.length-1];
  },
  getNext : function(){
	  if(this.index +1 >= this.videos.length) return this.videos[0];
	  return this.videos[this.index+1];
  },
  getPrev : function(){
	  if(this.index -1 <0 ) return this.videos[this.videos.length-1];
	  return this.videos[this.index-1];
  },
  size: function(){
    return this.videos.length;
  },
  getFromIndex:function(index){
    return this.videos[index];
  },
  rollToIndex:function(id){
    var found = -1;
    var i =0;
    this.videos.forEach(function(video){
      if(video.videoId === id) found =i;
      i++;
    });
    if(found==-1) return null;
    this.index = found;
    console.log("Curr index: "+this.index);
    return this.videos[this.index];
  }
} 
