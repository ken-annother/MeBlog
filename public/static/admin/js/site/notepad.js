$(function () {
    var note  = $('#summernote');
    note.summernote({
        lang: 'zh-CN',
        height: ($(window).height() - 440),
        focus: true,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']]
        ]
    });
});

