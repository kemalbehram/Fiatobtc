/*document.getElementById('btnCopy').addEventListener('click', ()=>{
	let copyArea= document.getElementById('copyArea');
	navigator.clipboard.whriteText(copyArea.value);*/


	const copyArea= document.getElementById('copyArea');
	const btnCopy= document.getElementById('btnCopy');
	btnCopy.onclick = function(){
		copyArea.select();
		document.execCommand('Copy');
	};
