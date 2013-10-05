function updateActionForm(){
	var selected = document.getElementById('actiontype').value;
	if(selected!='lobbyLord'){
		document.getElementById('lobbyLord').style.display = 'none';
	} else {
		document.getElementById('lobbyLord').style.display = 'block';
	}
}