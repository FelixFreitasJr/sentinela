<p><div class="data" id="data"></div></p>
<p><div class="relogio" id="relogio"></div></p>

<script>
    function atualizarRelogio() {
    const relogioElemento = document.getElementById('relogio');
    const dataElemento = document.getElementById('data');
    const agora = new Date();

    // Formatar a hora
    const horas = agora.getHours().toString().padStart(2, '0');
    const minutos = agora.getMinutes().toString().padStart(2, '0');
    const segundos = agora.getSeconds().toString().padStart(2, '0');
    const horaFormatada = `${horas}:${minutos}:${segundos}`;

    // Formatar a data
    const diasSemana = ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"];
    const meses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
    const diaSemana = diasSemana[agora.getDay()];
    const dia = agora.getDate();
    const mes = meses[agora.getMonth()];
    const ano = agora.getFullYear();

    const dataFormatada = `${diaSemana}, ${dia} de ${mes} de ${ano}`;

    // Exibir a hora e a data
    relogioElemento.textContent = horaFormatada;
    dataElemento.textContent = dataFormatada;
    }

    // Atualiza o relógio a cada segundo
    setInterval(atualizarRelogio, 1000);

    // Chama a função inicialmente para evitar um atraso de um segundo
    atualizarRelogio();
</script> <!-- javascript data e hora -->