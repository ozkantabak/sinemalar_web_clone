
        // Get the modal
        var modalGiris = document.getElementById('modalGiris');
        var modalKayit = document.getElementById('modalKayit');

        // Get the button that opens the modal
        var btnGiris = document.getElementById("btnGiris");
        var btnKayit = document.getElementById("btnKayit");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close");

        // When the user clicks on the button, open the modal 
        btnGiris.onclick = function () {
            modalGiris.style.display = "block";
        }
        btnKayit.onclick = function () {
            modalKayit.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span[0].onclick = function () {
            modalGiris.style.display = "none";
        }
        span[1].onclick = function () {
            modalKayit.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modalGiris.style.display = "none";
                modalKayit.style.display = "none";
            }
        }
		