function persona_edit_functions () {
// function to show input fields for motivations section
    $(document).ready(function () {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $("#motivationsAdd"); //Fields wrapper
        var add_button = $("#motivationBtn"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><input type="text" class="motivationsinput" name="motivation[]"/><a href="#" class="remove_field">&times;</a></div>'); //add input box
            }
        });
        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });

// function to show input fields for goals section
    $(document).ready(function () {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $("#goalAdd"); //Fields wrapper
        var add_button = $("#goalBtn"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><input type="text" class="motivationsinput" name="goal[]"/><a href="#" class="remove_field">&times;</a></div>'); //add input box
            }
        });
        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });

// function to show input fields for needs section
    $(document).ready(function () {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $("#needs"); //Fields wrapper
        var add_button = $("#needsBtn"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><input type="text" class="motivationsinput" name="need[]"/><a href="#" class="remove_field">&times;</a></div>'); //add input box
            }
        });
        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });

// function to show input fields for challeneges section
    $(document).ready(function () {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $("#challeneges"); //Fields wrapper
        var add_button = $("#challenegesBtn"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><input type="text" class="motivationsinput" name="challeneges[]"/><a href="#" class="remove_field">&times;</a></div>'); //add input box
            }
        });
        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });

// function to show input fields for frustrations section
    $(document).ready(function () {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $("#frustrations"); //Fields wrapper
        var add_button = $("#frustrationsBtn"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><input type="text" class="motivationsinput" name="frustrations[]"/><a href="#" class="remove_field">&times;</a></div>'); //add input box
            }
        });
        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });

// function to show input fields for technologies section
    $(document).ready(function () {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $("#tech"); //Fields wrapper
        var add_button = $("#techBtn"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><input type="text" class="motivationsinput" name="technologies[]"/><a href="#" class="remove_field">&times;</a></div>'); //add input box
            }
        });
        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });

    $('.profile-img-container img').click(function () {
        $('#uploadfile').click();
    });

// https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded accessed: 20th march 2018
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