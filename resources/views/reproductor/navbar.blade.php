<div class="fixed-bottom bg-dark text-white">
    <div class="container d-flex align-items-center justify-content-between py-2">
        <div class="d-flex align-items-center">
            <img id="song-image" src="/path/to/default-song-image.jpg" alt="Song Image" class="img-fluid" style="width: 50px; height: 50px;">
            <div class="ml-3">
                <div id="song-title"></div>
                <div id="song-artist"></div>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <button class="btn btn-outline-light btn-sm mx-1" onclick="previousSong()">⏮</button>
            <button class="btn btn-outline-light btn-sm mx-1" onclick="nextSong()">⏭</button>
        </div>
        <div class="d-flex align-items-center">
            <button class="btn btn-outline-light btn-sm mx-1" onclick="shuffleSongs()">🔀</button>
        </div>
    </div>
</div>

<script>
    let currentSongId = null;

    async function fetchSong(url) {
        try {
            const response = await fetch(url);
            const song = await response.json();


            document.getElementById('song-title').innerText = song.titulo;
            document.getElementById('song-artist').innerText = song.productora.nombre;
            document.getElementById('song-image').src = song.categoria.portada;  

 
            currentSongId = song.id;
        } catch (error) {
            console.error('Error fetching song:', error);
        }
    }

    function shuffleSongs() {
        fetchSong("{{ route('reproductor.random') }}");
    }

    function nextSong() {
        if (currentSongId !== null) {
            fetchSong(`/reproducir/siguiente/${currentSongId}`);
        }
    }

    function previousSong() {
        if (currentSongId !== null) {
            fetchSong(`/reproducir/anterior/${currentSongId}`);
        }
    }
</script>
