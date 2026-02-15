function Marcx(){
	this.ldr=('00000'+this.ldr).slice(-5)
}
function Ldr(longitud){
	this.longitud=('00000'+longitud).slice(-5)
}
Ldr.prototype=new Marcx()
var marcx=new Marcx();