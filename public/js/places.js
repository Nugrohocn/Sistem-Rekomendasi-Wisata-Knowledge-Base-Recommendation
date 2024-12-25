$(document).ready(function () {
    loadCarouselData(1); // Memuat data untuk halaman pertama

    // Fungsi untuk memuat data tempat wisata ke dalam carousel
    function loadCarouselData(page) {
        $.ajax({
            url: placesUrl + "?page=" + page, // Menggunakan URL yang dikirim dari Blade
            type: "GET",
            success: function (response) {
                const places = response.data;
                let carouselItems = "";
                let rowContent = "";
                let activeClass = ""; // Pastikan hanya item pertama yang aktif

                places.forEach((place, index) => {
                    // Menambahkan card ke dalam row
                    rowContent += `
                        <div class="col-md-4 mb-4">
                            <div class="card text-white shadow-lg border-0" style="cursor: pointer; border-radius: 15px;"
                                data-bs-toggle="modal" data-bs-target="#modalDetail${place.id}">
                                <img src="/storage/${place.foto}" class="card-img"
                                    style="height: 450px; object-fit: cover; border-radius: 15px;">
                                <div class="card-img-overlay d-flex flex-column justify-content-end"
                                    style="background: rgba(0, 0, 0, 0.6); border-radius: 15px;">
                                    <h5 class="card-title mb-2 fw-bold">${place.nama}</h5>
                                    <p class="card-text small">${place.location.nama}</p>
                                    <div class="d-flex align-items-center">
                                        <span class="text-warning me-1">★</span>
                                        <span>${place.rating.rate}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    // Menambahkan carousel-item setelah 3 card
                    if ((index + 1) % 3 === 0 || index === places.length - 1) {
                        carouselItems += `
                            <div class="carousel-item ${activeClass}">
                                <div class="row justify-content-center">
                                    ${rowContent}
                                </div>
                            </div>
                        `;
                        rowContent = ""; // Reset row setelah menambahkan ke carousel-item
                        activeClass = ""; // Pastikan hanya item pertama yang aktif
                    }
                });

                // Menambahkan carousel items ke dalam carousel
                $("#carouselItems").html(carouselItems);

                // Menambahkan kelas 'active' ke carousel-item pertama
                if (response.data.length > 0) {
                    $(".carousel-item:first").addClass("active");
                }
            },
            error: function () {
                console.log("Error loading data.");
            },
        });
    }

    // Event untuk pindah ke halaman berikutnya
    $("#placesCarousel").on("slid.bs.carousel", function () {
        let currentIndex = $("#placesCarousel .carousel-item-next").index();
        loadCarouselData(currentIndex + 1); // Memuat data halaman berikutnya
    });
});
