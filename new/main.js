$(document).ready(function () {
    $("#image").on("change", function () {
        let file = $(this).get(0).files[0];

        if (file) {
            let reader = new FileReader();
            reader.onload = function () {
                $("#previewImage").attr('src', reader.result).css({width: '250px', height:"250px"})
            }
            reader.readAsDataURL(file)
        }
        
    })
})