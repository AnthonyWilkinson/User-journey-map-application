function userJourneyFunctions() {
    var modal = document.getElementById('myModal');
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function () {
        modal.style.display = "block";
    };
    span.onclick = function () {
        modal.style.display = "none";
    };
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    var laneModal = document.getElementById('laneModal');
    var Button = document.getElementById("myBtn2");
    var close = document.getElementById("close");

    Button.onclick = function () {
        laneModal.style.display = "block";
    };
    close.onclick = function () {
        laneModal.style.display = "none";
    };
    window.onclick = function (event) {
        if (event.target == modal) {
            laneModal.style.display = "none";
        }
    };

    $('#image p').click(function () {
        $('#uploadfile').click();
    });

    function edit_stage(id, text) {
        $.ajax({
            url: "scripts/saveStageEdit.php",
            method: "POST",
            data: {id: id, text: text},
            dataType: "text"

        });
    }

    $(document).on('blur', '#editable_stage', function () {
        var id = $(this).data("id1");
        var text = $(this).text();
        edit_stage(id, text);
    });

    function edit_feeling(id, text) {
        $.ajax({
            url: "scripts/saveFeelingEdit.php",
            method: "POST",
            data: {id: id, text: text},
            dataType: "text"

        });
    }

    $(document).on('blur', '#editable_feeling', function () {
        var id = $(this).data("id1");
        var text = $(this).text();
        edit_feeling(id, text);
    });

    function edit_goals(id, text) {
        $.ajax({
            url: "scripts/saveGoalEdit.php",
            method: "POST",
            data: {id: id, text: text},
            dataType: "text"

        });
    }

    $(document).on('blur', '#editable_goal', function () {
        var id = $(this).data("id1");
        var text = $(this).text();
        edit_goals(id, text);
    });

    function edit_pain_points(id, text) {
        $.ajax({
            url: "scripts/savePainPointEdit.php",
            method: "POST",
            data: {id: id, text: text},
            dataType: "text"

        });
    }

    $(document).on('blur', '#editable_pain_point', function () {
        var id = $(this).data("id1");
        var text = $(this).text();
        edit_pain_points(id, text);
    });

    function edit_actions(id, text) {
        $.ajax({
            url: "scripts/saveActionsEdit.php",
            method: "POST",
            data: {id: id, text: text},
            dataType: "text"

        });
    }

    $(document).on('blur', '#editable_action', function () {
        var id = $(this).data("id1");
        var text = $(this).text();
        edit_actions(id, text);
    });

    function edit_opportunities(id, text) {
        $.ajax({
            url: "scripts/saveOpportunitiesEdit.php",
            method: "POST",
            data: {id: id, text: text},
            dataType: "text"

        });
    }

    $(document).on('blur', '#editable_opportunities', function () {
        var id = $(this).data("id1");
        var text = $(this).text();
        edit_opportunities(id, text);
    });

    function edit_thinking(id, text) {
        $.ajax({
            url: "scripts/saveThinkingEdit.php",
            method: "POST",
            data: {id: id, text: text},
            dataType: "text"

        });
    }

    $(document).on('blur', '#editable_thinking', function () {
        var id = $(this).data("id1");
        var text = $(this).text();
        edit_thinking(id, text);
    });

    function edit_needs(id, text) {
        $.ajax({
            url: "scripts/saveNeedEdit.php",
            method: "POST",
            data: {id: id, text: text},
            dataType: "text"

        });
    }

    $(document).on('blur', '#editable_needs', function () {
        var id = $(this).data("id1");
        var text = $(this).text();
        edit_needs(id, text);
    });
}