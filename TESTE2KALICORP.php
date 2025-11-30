<?php
$golpes_esquerda = [
    'LOW KICK',
    'MEDIUM-KICK',
    'TEEP',
    'THAI-TEEP',
    'COTOVELO'
];

$golpes_direita = [
    'JAB',
    'DIRETO',
    'JOELHO',
    'CRUZADO',
    'UPPER',
    'GANCHO'
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Treino</title>
    <style>
        body, html { margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f2f5; color: #333; }
        
        #configuracao { display: grid; grid-template-columns: 1fr 1.5fr 1fr; max-width: 1000px; margin: 30px auto; padding: 20px; gap: 20px; background-color: #fff; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        
        .coluna-golpes, .coluna-central { padding: 20px; border-radius: 8px; background-color: #f8f9fa; border: 1px solid #e9ecef; }
        .coluna-central { background-color: #fff; border: none; display: flex; flex-direction: column; justify-content: center; align-items: center; gap: 15px; }
        
        .lista-golpes { display: flex; flex-direction: column; gap: 12px; }
        .lista-golpes label { font-size: 1.1em; cursor: pointer; display: flex; align-items: center; padding: 5px; border-radius: 4px; transition: background 0.2s; }
        .lista-golpes label:hover { background-color: #e2e6ea; }
        .lista-golpes input[type="checkbox"] { transform: scale(1.4); margin-right: 15px; accent-color: #28a745; }
        
        .form-grupo { width: 100%; text-align: center; }
        .form-grupo label { display: block; font-size: 1.1em; font-weight: 700; margin-bottom: 8px; color: #495057; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-grupo select { width: 100%; padding: 12px; font-size: 1.1em; border: 2px solid #ced4da; border-radius: 6px; background-color: #fff; cursor: pointer; }
        
        .slider-container { width: 100%; margin: 10px 0; padding: 10px; background: #e9ecef; border-radius: 8px; }
        input[type=range] { width: 100%; cursor: pointer; }
        .valor-velocidade { font-weight: bold; color: #007bff; }

        .botoes-selecao { display: flex; justify-content: space-between; width: 100%; gap: 10px; }
        .btn-util { flex: 1; padding: 10px; font-size: 0.9em; background-color: #6c757d; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; }
        .btn-util:hover { background-color: #5a6268; }
        
        #btn-iniciar { width: 100%; padding: 18px; font-size: 1.6em; font-weight: 800; color: white; background-color: #28a745; border: none; border-radius: 8px; cursor: pointer; transition: transform 0.1s, background-color 0.3s; margin-top: 10px; box-shadow: 0 4px 6px rgba(40, 167, 69, 0.3); }
        #btn-iniciar:hover { background-color: #218838; transform: translateY(-2px); }
        #btn-iniciar:active { transform: translateY(0); }

        #tela-treino { display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: #000; color: #fff; flex-direction: column; justify-content: center; align-items: center; z-index: 9999; }
        #status-treino { font-size: 5vw; font-weight: bold; color: #ffc107; position: absolute; top: 30px; text-shadow: 2px 2px 4px #000; }
        #timer-display { font-size: 8vw; font-family: 'Courier New', monospace; font-weight: bold; color: #f8f9fa; text-shadow: 2px 2px 4px #000; }
        #palavra-display { font-size: 14vw; font-weight: 900; text-transform: uppercase; color: #fff; margin-top: -40px; text-align: center; line-height: 1; text-shadow: 3px 3px 6px #000; }
        
        #tela-treino[data-status="descanso"] { background-color: #222; }
        #tela-treino[data-status="descanso"] #palavra-display { display: none; }
        #tela-treino[data-status="descanso"] #timer-display { font-size: 20vw; color: #17a2b8; }
        
        #btn-parar { position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%); padding: 15px 40px; font-size: 1.2em; background-color: #dc3545; color: white; border: none; border-radius: 50px; opacity: 0.8; cursor: pointer; font-weight: bold; }
        #btn-parar:hover { opacity: 1; }
    </style>
</head>
<body>

    <div id="configuracao">
        <div class="coluna-golpes">
            <h3 style="text-align:center; margin-top:0;">Kicks / Defesa</h3>
            <div class="lista-golpes">
                <?php
                    foreach ($golpes_esquerda as $golpe) {
                        echo "<label><input type='checkbox' class='movimento' value='{$golpe}'> {$golpe}</label>";
                    }
                ?>
            </div>
        </div>

        <div class="coluna-central">
            <div class="form-grupo">
                <label for="tempo-round">Duração do Round</label>
                <select id="tempo-round">
                    <option value="1">1 Minuto</option>
                    <option value="2">2 Minutos</option>
                    <option value="3" selected>3 Minutos</option>
                    <option value="4">4 Minutos</option>
                    <option value="5">5 Minutos</option>
                </select>
            </div>
            
            <div class="form-grupo">
                <label for="qtd-rounds">Quantidade de Rounds</label>
                <select id="qtd-rounds">
                    <option value="1">1 Round</option>
                    <option value="2">2 Rounds</option>
                    <option value="3" selected>3 Rounds</option>
                    <option value="4">4 Rounds</option>
                    <option value="5">5 Rounds</option>
                    <option value="10">10 Rounds</option>
                </select>
            </div>

            <div class="form-grupo">
                <label for="velocidade-voz">Velocidade da Voz: <span id="display-velocidade" class="valor-velocidade">1.8x</span></label>
                <div class="slider-container">
                    <input type="range" id="velocidade-voz" min="1.0" max="3.0" step="0.1" value="1.8">
                    <small style="display:block; margin-top:5px; color:#666;">(1.0 = Normal | 3.0 = Muito Rápido)</small>
                </div>
            </div>

            <div class="botoes-selecao">
                <button id="btn-select-all" class="btn-util">Marcar Todos</button>
                <button id="btn-clear-all" class="btn-util">Limpar</button>
            </div>

            <button id="btn-iniciar">LET'S GO!</button>
        </div>

        <div class="coluna-golpes">
            <h3 style="text-align:center; margin-top:0;">Socos / Ataque</h3>
            <div class="lista-golpes">
                 <?php
                    foreach ($golpes_direita as $golpe) {
                        echo "<label><input type='checkbox' class='movimento' value='{$golpe}'> {$golpe}</label>";
                    }
                ?>
            </div>
        </div>
    </div>

    <div id="tela-treino">
        <div id="status-treino">ROUND 1</div>
        <div id="timer-display">00:00</div>
        <div id="palavra-display">...</div>
        <button id="btn-parar">Parar / Voltar</button>
    </div>

    <script>
        const telaConfig = document.getElementById('configuracao');
        const telaTreino = document.getElementById('tela-treino');
        const btnIniciar = document.getElementById('btn-iniciar');
        const btnParar = document.getElementById('btn-parar');
        const selectTempo = document.getElementById('tempo-round');
        const selectRounds = document.getElementById('qtd-rounds');
        const inputVelocidade = document.getElementById('velocidade-voz');
        const displayVelocidade = document.getElementById('display-velocidade');
        const btnSelectAll = document.getElementById('btn-select-all');
        const btnClearAll = document.getElementById('btn-clear-all');
        const statusDisplay = document.getElementById('status-treino');
        const timerDisplay = document.getElementById('timer-display');
        const palavraDisplay = document.getElementById('palavra-display');

        let palavrasSelecionadas = [];
        let duracaoRoundMs = 0;
        let duracaoDescansoMs = 60000; 
        let totalRounds = 0;
        let roundAtual = 1;
        let tempoRestanteMs = 0;
        let isTreinando = false; 
        let timerPrincipal;     
        let intervaloPalavra;   
        let ultimaPalavraExibida = null;

        inputVelocidade.addEventListener('input', function() {
            displayVelocidade.textContent = this.value + 'x';
        });

        // --- MAPA DE PRONÚNCIA (O SEGREDO ESTÁ AQUI) ---
        // Se a palavra estiver aqui, ele fala o valor da direita.
        // Se não estiver, ele fala a palavra original em minúsculo.
        const correcoesPronuncia = {
            'JAB': 'Djéb',           // Força "Djéb"
            'LOW KICK': 'Lou quic',  // Força "Lou quic"
            'MEDIUM-KICK': 'Médium quic',
            'THAI-TEEP': 'Tai tip',
            'TEEP': 'Tip',
            'UPPER': 'Âper'          // Força "Âper" em vez de "Uper"
        };

        function falar(texto) {
            window.speechSynthesis.cancel();

            // 1. Verifica no mapa se tem uma pronúncia "abrasileirada"
            let textoParaFalar = correcoesPronuncia[texto];

            // 2. Se não tiver no mapa, usa o original, mas em MINÚSCULO
            // (Minúsculo evita que ele soletre J.A.B)
            if (!textoParaFalar) {
                textoParaFalar = texto.toLowerCase();
            }

            const utterance = new SpeechSynthesisUtterance(textoParaFalar);
            utterance.lang = 'pt-BR'; 
            utterance.rate = parseFloat(inputVelocidade.value);
            utterance.pitch = 1.0; 

            window.speechSynthesis.speak(utterance);
        }

        function iniciarTreinoCompleto() {
            palavrasSelecionadas = Array.from(document.querySelectorAll('.movimento:checked')).map(cb => cb.value);
            duracaoRoundMs = parseInt(selectTempo.value, 10) * 60 * 1000;
            totalRounds = parseInt(selectRounds.value, 10);
            
            if (palavrasSelecionadas.length === 0) { alert("Selecione movimentos!"); return; }
            
            window.speechSynthesis.getVoices();

            roundAtual = 1;
            ultimaPalavraExibida = null; 
            telaConfig.style.display = 'none';
            telaTreino.style.display = 'flex';
            ativarTelaCheia();
            iniciarRound();
        }

        function iniciarRound() {
            isTreinando = true;
            tempoRestanteMs = duracaoRoundMs;
            statusDisplay.textContent = `ROUND ${roundAtual}`;
            telaTreino.setAttribute('data-status', 'treino');
            atualizarTimerDisplay(); 

            falar("Round " + roundAtual);

            setTimeout(() => {
                mostrarProximaPalavra(); 
                intervaloPalavra = setInterval(mostrarProximaPalavra, 1000); 
                timerPrincipal = setInterval(tick, 1000);
            }, 1500);
        }

        function iniciarDescanso() {
            isTreinando = false;
            tempoRestanteMs = duracaoDescansoMs;
            clearInterval(intervaloPalavra);
            statusDisplay.textContent = "DESCANSO";
            palavraDisplay.textContent = ""; 
            telaTreino.setAttribute('data-status', 'descanso');
            atualizarTimerDisplay(); 
            falar("Descanso"); 
        }

        function tick() {
            tempoRestanteMs -= 1000; 
            atualizarTimerDisplay();
            if (tempoRestanteMs <= 0) {
                clearInterval(timerPrincipal);
                if (isTreinando) {
                    clearInterval(intervaloPalavra); 
                    if (roundAtual >= totalRounds) {
                        pararTreinoCompleto("Fim do Treino");
                    } else {
                        iniciarDescanso();
                        timerPrincipal = setInterval(tick, 1000);
                    }
                } else {
                    roundAtual++;
                    iniciarRound(); 
                }
            }
        }
        
        function pararTreinoCompleto(mensagem = "Treino Parado") {
            clearInterval(timerPrincipal);
            clearInterval(intervaloPalavra);
            window.speechSynthesis.cancel();
            desativarTelaCheia();
            telaTreino.style.display = 'none';
            telaConfig.style.display = 'grid';
            roundAtual = 1;
            if (mensagem) { falar(mensagem); alert(mensagem); }
        }

        function mostrarProximaPalavra() {
            if (palavrasSelecionadas.length === 0) return;
            let palavraSorteada;
            if (palavrasSelecionadas.length === 1) {
                palavraSorteada = palavrasSelecionadas[0];
            } else {
                do {
                    const indiceAleatorio = Math.floor(Math.random() * palavrasSelecionadas.length);
                    palavraSorteada = palavrasSelecionadas[indiceAleatorio];
                } while (palavraSorteada === ultimaPalavraExibida);
            }
            ultimaPalavraExibida = palavraSorteada;
            palavraDisplay.textContent = palavraSorteada;
            
            // Chama a função de fala (que agora vai corrigir a pronúncia)
            falar(palavraSorteada); 
        }

        function atualizarTimerDisplay() {
            const minutos = Math.floor(tempoRestanteMs / 60000);
            const segundos = Math.floor((tempoRestanteMs % 60000) / 1000);
            timerDisplay.textContent = `${String(minutos).padStart(2, '0')}:${String(segundos).padStart(2, '0')}`;
        }

        function ativarTelaCheia() {
            const elem = document.documentElement;
            if (elem.requestFullscreen) elem.requestFullscreen();
            else if (elem.webkitRequestFullscreen) elem.webkitRequestFullscreen();
        }

        function desativarTelaCheia() {
            if (document.exitFullscreen) document.exitFullscreen();
            else if (document.webkitExitFullscreen) document.webkitExitFullscreen();
        }

        btnIniciar.addEventListener('click', iniciarTreinoCompleto);
        btnParar.addEventListener('click', () => pararTreinoCompleto("Parado"));
        btnSelectAll.addEventListener('click', () => document.querySelectorAll('.movimento').forEach(cb => cb.checked = true));
        btnClearAll.addEventListener('click', () => document.querySelectorAll('.movimento').forEach(cb => cb.checked = false));
    </script>
</body>
</html>