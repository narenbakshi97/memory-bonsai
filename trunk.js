function Trunk(){
	this.x = width*(1/4)+30;
	this.y = 50;
	
	this.checkTrunk = function(mx,my,px,py,l){
		if(dist(mx,my,px,py) < l){
			showAddSign(px,py,l);
		}
	};
	this.show = function(){
		image(trunk,this.x,this.y,pot.width/1.5,pot.height*1.3);
	}
}

function showAddSign(px,py,l){
	image(plus,px,py,l,l);
}