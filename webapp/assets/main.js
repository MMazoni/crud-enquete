function setResponse(e){
    let button = document.querySelector('.response-change');
    if(button){
        button.classList.remove('response-change')
    }
    const element = document.querySelector(`.response-${e}`);
    element.classList.add("response-change");
}


function onSubmit(id_enquete){
    let button = document.querySelector('.response-change');
    if(button){
        button = button.className.split(' ')[0];
        let id_opcao = parseInt(button.split('-')[1]);

        const requestData = `id_opcao=${id_opcao}&id_enquete=${id_enquete}`;

        const request = new XMLHttpRequest();
        request.open('POST', 'ajax.php', true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(requestData);

        request.onreadystatechange = function() {

            if (request.readyState == 4 && request.status == 200) {
                let responseData = JSON.parse(request.responseText);

                const dadosResultados = document.getElementsByClassName('hide');
                for (let i = 0; i < dadosResultados.length; i++) {
                    dadosResultados[i].style.display = "flex";
                }
                
                document.getElementById('btn-vote').style.display = 'none';
                document.getElementById('btn-return').style.display = 'block';
                let valorTotal = 0
                
                for (let i = 0; i < responseData.length; i++) {
                    document.getElementById('qnt-votos-'+responseData[i]['id_opcao']).innerHTML = responseData[i]['qnt_votos'] + ' votos';
                    valorTotal = valorTotal + responseData[i]['qnt_votos'];
                }
                let valor = 0;
                for (let i = 0; i < responseData.length; i++) {
                    valor = ((responseData[i]['qnt_votos'] * 100) / valorTotal).toFixed(2); 
                    document.getElementById('porc-votos-'+responseData[i]['id_opcao']).innerHTML = `${valor}%`;
                    document.getElementById('barra-porc-'+responseData[i]['id_opcao']).style.width = `${valor}%`;
                    document.getElementById('barra-falt-'+responseData[i]['id_opcao']).style.width = `${(100 - valor)}%`;

                }
            }
        }
    } 
}