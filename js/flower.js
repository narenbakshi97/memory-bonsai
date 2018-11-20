function MemoryFlower(title,memory,date,time,img,index){
	this.x = random(400,800);
	this.y = random(50,225);
	this.title = title;
	this.memory = memory;
	this.date = date;
	this.time = time;
	this.img = img;
	this.index = index;

	this.checkClicked = function(px,py){
		let d = dist(this.x+25,this.y+25,px,py);
		if(d < 20){
			showMemory(this);
		}
	};
	this.show = function(){
		image(flower,this.x,this.y,flowerSize,flowerSize);
	};
}