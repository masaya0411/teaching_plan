
    $('#lessonNew').validate({
        errorElement: "span",
        errorClass: "text-danger border-danger",
        validClass: "border-success",
        rules: {
            title: {
              required: true,
              maxlength: 255,
            },
            date: {
                required: true,
                birth: true,
            },
            period: {
                required: true,
                number: true,
            },
            goal: {
                required: true,
                maxlength: 255,
            },
          },
        messages: {
            title: {
                required: '入力必須です',
                maxlength: '255文字以内で入力してください',
            },
            date: {
                required: '入力必須です',
                birth: '日付を入力してください',
            },
            period: {
                required: '入力必須です',
                number: '数字を入力してください',
            },
            goal: {
                required: '入力必須です',
                maxlength: '255文字以内で入力してください',
            },
        },
    });
