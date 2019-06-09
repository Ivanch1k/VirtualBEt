<div id="myModalMoney" class="modal">
    <div class="modal-content">
        <div class="modal-header1">
            <h2 class="modal-text">Получение валюты</h2>
            <span id="closeMoney" class="close">&times;</span>
        </div>
        <div class="modal-body1">
            Получить 30 единиц виртуальной валюты
        </div>
        <div class="modal-footer1">
            <button type="button" id="getMoneyBtn" class="btn-regestration">Получить</button>
        </div>
        <div class="errorMes" id="getMoneyErrorMes"></div>
        <div class="video-container">
            <video id="videoMoney" width="400" height="300" >
                <source src="video/1xBet.mp4" type='video/mp4;"'>
                Тег video не поддерживается вашим браузером.
            </video>
        </div>

    </div>

</div>



<script>
    const modal = document.getElementById("myModalMoney");

    const span = document.getElementById("closeMoney");


    span.onclick = () => {
        modal.style.display = "none";
    }

    window.onclick = (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
</script>