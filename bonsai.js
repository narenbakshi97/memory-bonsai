//the canvas
var cnv;

// the images
var pot,trunk,flower,plus,close,base;

// the blossoms and the trunk
var memoryFlowers = [], tableData = [], flowerSize = 50, c1, c2;

var treeTrunk;

//Inputs for the 6 fields
var button, i1,i2,i3,i4,i5,i6;

// Close those forms
var formOpen, memoryOpen, formDiv, memoryDiv;

//Plus x, y
var plusX = 550;
var plusY = 450;
var plusLength = 110;

function preload(){
	base = loadImage("base.png")
	pot = loadImage("pot.png");
	trunk = loadImage("trunk.png");
	flower = loadImage("flower.png");
	plus = loadImage("plus.png");
	close = loadImage("close.png");
}
function setup(){
	cnv = createCanvas(windowWidth, windowHeight);
	cnv.parent("tree");
	cnv.style('margin-left','-15px');
	cnv.style('margin-top','5%');
  	cnv.style('background','transparent');
	//init trunk
	newFlower();
	treeTrunk = new Trunk();

	formOpen = false;
	memoryOpen = false;

	c1 = new CloseButton();
	c2 = new CloseButton();
}
function draw(){
	clear();
	image(pot,width/4,410,pot.width/1.5,pot.height/1.5);
	image(base,0,pot.height/1.5+390,width,base.height/1.5);
	treeTrunk.show();
	treeTrunk.checkTrunk(mouseX,mouseY,plusX,plusY,plusLength);

	//The flowers
	for(let i = 0; i < memoryFlowers.length; i++){
		memoryFlowers[i].show();
	}


	if(formOpen == true){
		c1.show();
	}

	if(memoryOpen == true){
		c2.show();
	}
}

function mousePressed(){
	if(dist(mouseX,mouseY,plusX,plusY) < plusLength){
		formOpen = true;
		formDiv = null;
		formDiv = createDiv("<form method='post' enctype='multipart/form-data'><div class='form-group'><div class='label-control'>Title</div><div class='form-control'><input type='text' name='title' placeholder='The title of the memory' required/></div></div>  <div class='form-group'><div class='label-control'>Date</div><div class='form-control'><input type='date' name='date' placeholder='The date' required/></div></div>   <div class='form-group'><div class='label-control'>Time</div><div class='form-control'><input type='time' name='time' placeholder='The time' required/></div></div>     <div class='form-group'><div class='label-control'>Picture</div><div class='form-control'><input type='file' name='userfile' required/></div></div>  <div class='form-group'><div class='label-control'>Memory</div><div class='form-control'><textarea name='memory' placeholder='Tell us all about that day!'></textarea></div></div> <div class='form-group'><div class='form-control'><input class='btn btn-pink btn-block' type='submit' value='submit' name='submit'/></div></div></form>");
		formDiv.id("formDiv");
		formDiv.addClass("col-md-12");
		formDiv.position(0,0);
	}	

	for(let i = 0; i < memoryFlowers.length; i++){
		memoryFlowers[i].checkClicked(mouseX,mouseY);
	}

	if(formOpen == true){
		if(c1.clicked(mouseX,mouseY)){
			formDiv.hide();
			formOpen = false;
		}
	}

	if(memoryOpen == true){
		if(c2.clicked(mouseX,mouseY)){
			memoryDiv.hide();
			memoryOpen = false;
		}
	}
}

function CloseButton(){
	this.x = width-100;
	this.y = 0;
	this.r = 100;
	this.show = function(){
		image(close,this.x,this.y,this.r,this.r);
	}
	this.clicked = function(mx,my){
		if(dist(mx,my,this.x+50,this.y+50) < 50){
			return true;
		}
		else{
			return false;
		}
	}
}