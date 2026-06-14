function curtirPost(
    postId,
    botao
)
{
    let formData =
        new FormData();

    formData.append(
        "post_id",
        postId
    );

    fetch(
        "?url=curtir",
        {
            method: "POST",
            body: formData
        }
    )
    .then(
        response =>
        response.json()
    )
    .then(
        data =>
        {
            botao.querySelector(
                "span"
            ).innerText =
            data.total;
        }
    );
}