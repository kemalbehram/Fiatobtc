
document.getElementById('btnPaste').addEventListener('click', ()=>{
	let pastArea = document.getElementById('pastArea');
	pastArea.value='';

	navigator.clipboard.readText()
	.then((text)=>{
		pastArea.value= text;
	});
});

//ID DE LA TRANSACTION
document.getElementById('btnPasteIdtransaction').addEventListener('click', ()=>{
	let pastArea = document.getElementById('pasteIdtransaction');
	pastArea.value='';

	navigator.clipboard.readText()
	.then((text)=>{
		pastArea.value= text;
	});
});





    

