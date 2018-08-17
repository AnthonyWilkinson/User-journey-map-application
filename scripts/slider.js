function sliderAction () {
    var slider = document.getElementById("myRange");
    var output = document.getElementById("demo");
    output.innerHTML = slider.value;

    if (slider.value =='1') {
        output.innerHTML = "Never have. Never will.";
    }
    if (slider.value == '2') {
        output.innerHTML = "Was online but no longer.";
    }
    if (slider.value =='3') {
        output.innerHTML = "Willing and unable";
    }
    if (slider.value == '4') {
        output.innerHTML = "Reluctantly online";
    }
    if (slider.value == '5') {
        output.innerHTML = "Learning the ropes";
    }
    if (slider.value == '6') {
        output.innerHTML = "Task specific";
    }
    if (slider.value == '7') {
        output.innerHTML = "Basic digital skills";
    }
    if (slider.value == '8') {
        output.innerHTML = "Confident";
    }
    if (slider.value == '9') {
        output.innerHTML = "Expert";
    }

    slider.oninput = function() {
        if (slider.value =='1') {
            output.innerHTML = "Never have. Never will.";
        }
        if (slider.value == '2') {
            output.innerHTML = "Was online but no longer.";
        }
        if (slider.value =='3') {
            output.innerHTML = "Willing and unable";
        }
        if (slider.value == '4') {
            output.innerHTML = "Reluctantly online";
        }
        if (slider.value == '5') {
            output.innerHTML = "Learning the ropes";
        }
        if (slider.value == '6') {
            output.innerHTML = "Task specific";
        }
        if (slider.value == '7') {
            output.innerHTML = "Basic digital skills";
        }
        if (slider.value == '8') {
            output.innerHTML = "Confident";
        }
        if (slider.value == '9') {
            output.innerHTML = "Expert";
        }
    };

    $('.profile-img-container img').click(function () {
        $('#uploadfile').click();
    });

    // https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#uploadfile").change(function () {
        readURL(this);
    });
}
