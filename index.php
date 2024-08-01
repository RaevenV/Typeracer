<?php
include './scripts/include/functions.php';
include_once './scripts/db_config.php';
session_start(); // Starting Session

$query = "SELECT COUNT(*) as total FROM texts";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$total_rows = $row['total'];

$random_number = rand(1, $total_rows);

$query = "SELECT content FROM texts WHERE id = $random_number";
$result = mysqli_query($conn, $query);
$text = '';
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $text = $row['content'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Type Racer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" href="favicon.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/index.css" rel="stylesheet">
    <!-- Colors -->
    <link href="css/css-index.css" rel="stylesheet" media="screen">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" />
    <link href="css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100..900&family=Playwrite+AR:wght@100..400&display=swap" rel="stylesheet">

    <style>
        .highlight {
            background-color: yellow;
            display: inline-block;
            color: black;
        }

        .wrong {
            background-color: red;
            display: inline-block;
        }

        .wpm-wrapper {
            display: none;
        }
    </style>
</head>

<body data-spy="scroll" data-target="#navbar-scroll">

    <div style="background-color:#7aa0de; min-height: 100vh; display:flex; justify-content:flex-start;align-items:center;flex-direction:column; padding:50px">
        <div class="countdown-container" style="font-family: Playwrite AR, cursive; margin-bottom:60px; margin-top:20px">
            Press Start!
        </div>

        <div class="textTB-container">
            <div class="textTB">
                <?php
                $words = explode(" ", $text);
                foreach ($words as $i => $word) {
                    echo "<span id='word-$i'>$word</span> ";
                }
                ?>
            </div>
        </div>
        
        <div class="inputTB-container">
            <input class="form-control inputTB" id="input" autocomplete="off">
        </div>
        <div class="startBtn-container">
            <button type="button" class="btn btn-success startBtn" style="border-radius: 16px;">Start</button>
        </div>

        <div class="wpm-container">
            <div class="wpm-wrapper">
            </div>
        </div>
    </div>

    <!-- /.javascript files -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <!-- ChartJS -->
    <script src="js/chart.js/Chart.min.js"></script>

    <script src="js/jquery.dataTables.min.js"></script>
    <script>
        const startBtn = document.querySelector('.startBtn');
        const countdownEl = document.querySelector('.countdown-container');
        const text = <?php echo json_encode($text); ?>;
        const parsedText = text.split(" ");
        let index = 0;
        const input = document.getElementById('input');
        const wpmWrapper = document.querySelector('.wpm-wrapper');
        let timer;
        let startTime;
    
        startBtn.addEventListener('click', startCountdown);

        function startCountdown() {
            let countdown = 3;
            countdownEl.textContent = countdown;
            input.disabled = true;
            timer = setInterval(() => {
                countdown--;
                if (countdown === 0) {
                    clearInterval(timer);
                    countdownEl.textContent = '';
                    input.disabled = false;
                    input.focus();
                    startTimer();
                    highlightCurrentWord();
                } else {
                    countdownEl.textContent = countdown;
                }
            }, 1000);
        }

        function startTimer() {
            startTime = Date.now();
            timer = setInterval(() => {
                const elapsedTime = Date.now() - startTime;
                const minutes = Math.floor(elapsedTime / 60000);
                const seconds = Math.floor((elapsedTime % 60000) / 1000);
                countdownEl.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            }, 1000);
        }

        function highlightCurrentWord() {
            document.querySelectorAll('.highlight').forEach(el => el.classList.remove('highlight'));
            document.querySelectorAll('.wrong').forEach(el => el.classList.remove('wrong'));
            const currentWordEl = document.getElementById(`word-${index}`);
            if (currentWordEl) {
                currentWordEl.classList.add('highlight');
            }
        }

        function wrong() {
            document.querySelectorAll('.highlight').forEach(el => el.classList.remove('highlight'));
            const currentWordEl = document.getElementById(`word-${index}`);
            if (currentWordEl) {
                currentWordEl.classList.add('wrong');
            }
        }

        function clearTime(){
            countdownEl.textContent = "";
        }

        function calculateWPM() {
            const elapsedTime = (Date.now() - startTime) / 1000; // in seconds
            const wordsTyped = index;
            const wpm = (wordsTyped / elapsedTime) * 60;
            return Math.round(wpm);
        }

        input.addEventListener('keyup', (event) => {
            const value = input.value.trim();
            if (event.key === ' ') {
                if (parsedText[index] === value) {
                    index++;
                    input.value = '';
                    if (index === parsedText.length) {
                        clearInterval(timer);
                        const wpm = calculateWPM();
                        wpmWrapper.textContent = `Your WPM is ${wpm}`;
                        wpmWrapper.style.display = 'block';
                        clearTime();
                    } else {
                        highlightCurrentWord();
                    }
                } else {
                    wrong();
                }
            }
        });
    </script>
</body>

</html>
