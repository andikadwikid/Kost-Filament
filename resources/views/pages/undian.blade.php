<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>

    </style>
</head>

<body>

    <div class="flex items-center justify-center bg-red-500 h-screen">
        <div class="max-w-3xl w-full rounded overflow-hidden shadow-lg bg-white p-5">
            <div class="flex flex-col items-center justify-center">
                <div id="slot"
                    class="text-4xl font-bold border p-4 w-full text-center overflow-hidden text-ellipsis whitespace-nowrap">
                    ---
                </div>
                <div id="result" class="text-xl mt-4 font-semibold w-full break-words text-center">
                    Press
                    Spin to Start</div>
            </div>
            <div class="flex flex-col items-center justify-center">
                <div>
                    <div class="flex space-x-4 my-5">
                        <button id="spinButton" class="bg-blue-500 text-white px-4 py-2 rounded">Spin</button>
                        <button id="stopButton" class="bg-red-500 text-white px-4 py-2 rounded hidden">Stop</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <div id="slot" class="text-4xl font-bold border p-4 w-64 text-center min-w-full">---</div>
        <p id="result" class="text-xl mt-4 font-semibold">Press Spin to Start</p>
        <div class="flex space-x-4 my-5">
            <button id="spinButton" class="bg-blue-500 text-white px-4 py-2 rounded">Spin</button>
            <button id="stopButton" class="bg-red-500 text-white px-4 py-2 rounded hidden">Stop</button>
        </div>
    </div> --}}
    <audio id="spinSound" src="{{ asset('assets/sound-machine-play-2.mp3') }}"></audio>
    <audio id="endSpinSound" src="{{ asset('assets/end-spin.mp3') }}"></audio>
    <audio id="stopSound" src="{{ asset('assets/sound-machine-win.mp3') }}"></audio>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // List nama-nama yang akan diundi
            const items = [
                "AliceAliceAliceAliceAliceAliceAliceAliceAliceAliceAliceAliceAliceAliceAliceAliceAliceAliceAliceAliceAliceAliceAliceAlice",
                "BobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBobBob",
                "CharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlieCharlie",
                "DianaDianaDianaDianaDianaDianaDianaDianaDianaDianaDianaDianaDianaDianaDianaDianaDianaDianaDianaDianaDianaDianaDianaDianaDianaDianaDiana",
                "EvelynEvelynEvelynEvelynEvelynEvelynEvelynEvelynEvelynEvelynEvelynEvelynEvelynEvelynEvelynEvelynEvelynEvelynEvelynEvelynEvelynEvelynEvelynEvelyn",
                "FrankFrankFrankFrankFrankFrankFrankFrankFrankFrankFrankFrankFrankFrankFrankFrankFrankFrankFrankFrankFrankFrankFrankFrankFrankFrankFrank",
                "GraceGraceGraceGraceGraceGraceGraceGraceGraceGraceGraceGraceGraceGraceGraceGraceGraceGraceGraceGraceGrace",
                "HannahHannahHannahHannahHannahHannahHannahHannahHannahHannahHannahHannahHannahHannahHannahHannahHannahHannahHannahHannahHannahHannahHannahHannah",
                "IvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvyIvy",
            ];

            // const items = [];
            // const totalItems = 1000; // Jumlah angka yang ingin dibuat

            // for (let i = 1; i <= totalItems; i++) {
            //     items.push(i.toString().padStart(5, '0')); // Menggunakan padStart untuk menambahkan 0 di depan
            // }

            const spinButton = document.getElementById("spinButton");
            const stopButton = document.getElementById("stopButton");
            const slot = document.getElementById("slot");
            const resultText = document.getElementById("result");

            const spinSound = document.getElementById("spinSound");
            const endSpinSound = document.getElementById("endSpinSound");
            const stopSound = document.getElementById("stopSound");

            let interval;

            // Fungsi untuk memulai spin
            const spinSlot = () => {
                resultText.textContent = "Spinning...";
                spinButton.classList.add("hidden");
                stopButton.classList.remove("hidden");

                endSpinSound.pause();
                endSpinSound.currentTime = 0;
                // Hentikan audio stopSound jika masih diputar
                stopSound.pause();
                stopSound.currentTime = 0;

                // Putar audio spinSound
                spinSound.currentTime = 0;
                spinSound.loop = true;
                spinSound.play();

                interval = setInterval(() => {
                    slot.textContent = items[Math.floor(Math.random() * items.length)];
                }, 10); // Ubah nama setiap 10ms
            };

            // Fungsi untuk menghentikan spin
            const stopSlot = () => {
                clearInterval(interval);
                spinSound.pause();

                // Putar audio endSpinSound terlebih dahulu
                endSpinSound.currentTime = 0;
                endSpinSound.play();

                // Setelah endSpinSound selesai, putar stopSound
                endSpinSound.addEventListener('ended', () => {
                    stopSound.currentTime = 0;
                    stopSound.play();
                });

                // Pilih pemenang acak setelah stop
                winner = items[Math.floor(Math.random() * items.length)];
                slot.textContent = winner;

                stopButton.classList.add("hidden");
                spinButton.classList.remove("hidden");

                resultText.innerHTML = `<p>🎉 Winner</p> <p>${winner}</p> !`;
            };

            spinButton.addEventListener("click", spinSlot);
            stopButton.addEventListener("click", stopSlot);
        });
    </script>
</body>

</html>
