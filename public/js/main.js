$('body').on('click', '.import', function () {
    let action = this.dataset.action;
    $.ajax({
        url:'/import/' + action,
        type: 'POST',
        success: function(res) {
            const summaryPanel = document.getElementById("mainTable");
            summaryPanel.innerHTML = res;
        }
    });
});