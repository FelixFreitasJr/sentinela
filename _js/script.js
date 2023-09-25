        // Função para formatar a data por extenso
        function formatarDataPorExtenso(data) {
            //var diasSemana = ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"];
            var meses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
           // var diaSemana = diasSemana[data.getDay()];
            var dia = data.getDate();
            var mes = meses[data.getMonth()];
            var ano = data.getFullYear();
            return dia + ' de ' + mes + ' de ' + ano;
        }

        // Função para atualizar a hora e os minutos
        function atualizarHoraMinutos() {
            var dataHoraAtual = new Date();
            var horas = dataHoraAtual.getHours();
            var minutos = dataHoraAtual.getMinutes();
            minutos = minutos < 10 ? "0" + minutos : minutos; // Adiciona um zero à esquerda se for menor que 10
            return horas + ":" + minutos;
        }

        // Função para atualizar a data e hora na página
        function atualizarDataHora() {
            var dataPorExtenso = formatarDataPorExtenso(new Date());
            var horaMinutos = atualizarHoraMinutos();
            document.getElementById("data-hora").innerHTML = "Rio de Janeiro, " + dataPorExtenso + " ás " + horaMinutos;
        }

        // Chama a função inicialmente
        atualizarDataHora();

        // Adiciona um evento 'DOMContentLoaded'
            document.addEventListener('DOMContentLoaded', function() {
         // Coloque aqui qualquer código JavaScript que precise ser executado após o carregamento do DOM.
         // Isso inclui a chamada da função 'atualizarDataHora()' se necessário.
});

        // Atualiza a hora a cada minuto
        setInterval(function () {
            atualizarDataHora();
        }, 60000); // 60000 milissegundos = 1 minuto

        // Função para mostrar a seção de cadastro quando clicar no botão "Cadastrar"
        function mostrarCadastro() {
            var cadastro = document.getElementById("cadastro");
            cadastro.style.display = "block";
        }

        // Função para validar o CPF no lado do cliente
        function validarCPF(cpf) {
            cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos
            if (cpf.length !== 11 || !Array.from(cpf).every(digit => digit === cpf[0])) {
                alert("CPF inválido");
                return false;
            }
            let sum = 0;
            for (let i = 0; i < 9; i++) {
                sum += parseInt(cpf.charAt(i)) * (10 - i);
            }
            let remainder = 11 - (sum % 11);
            if (remainder === 10 || remainder === 11) {
                remainder = 0;
            }
            if (remainder !== parseInt(cpf.charAt(9))) {
                alert("CPF inválido");
                return false;
            }
            sum = 0;
            for (let i = 0; i < 10; i++) {
                sum += parseInt(cpf.charAt(i)) * (11 - i);
            }
            remainder = 11 - (sum % 11);
            if (remainder === 10 || remainder === 11) {
                remainder = 0;
            }
            if (remainder !== parseInt(cpf.charAt(10))) {
                alert("CPF inválido");
                return false;
            }
            return true;
        }
