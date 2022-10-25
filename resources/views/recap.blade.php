<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>

<div class="card" style="width: 22rem;">
    <div class="card-body">
        <h5 class="card-title">Prestation </h5>
        <h6 class="card-subtitle mb-2 text-muted"><span style="font-size: 4rem">💶</span></h6>
        <p class="card-text">Prestation réalisée : {{ $developerPrestation->prestation->name }}</p>
        <p>Développeur l'ayant réalisé : {{ $developerPrestation->developer->user->firstname .' '. $developerPrestation->developer->user->lastname }}</p>
        <p>Prix de la prestation : {{ $developerPrestation->price }}€</p>

        <button type="submit"
                id="checkout-button"
                class="btn btn-primary">Payer | {{ $developerPrestation->price }}€
        </button>

        <input type="hidden"
               name="prestation_id"
               value="{{ $developerPrestation->id }}"
        />

    </div>
</div>


<script type="text/javascript">
    const stripe = Stripe("pk_test_51LvRpVGm3pNtvPq2yw4FJAidMlz7WBk3lx0fjxuc8doN0Zhk7RK9x4RHO42KVQLKoSYlJ6cbCQpBXMcd7guJ7cWt00s0z2mpMO");
    const checkoutButton = document.getElementById("checkout-button");
    let prestationId = document.querySelector('input[name="prestation_id"]').value;

    checkoutButton.addEventListener("click", function () {
        fetch("/order/create-session/" + prestationId, {
            method: "POST"
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (session) {
                return stripe.redirectToCheckout({sessionId: session.id});
            })
            .then(function (result) {
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(function (error) {
                console.error("Error: " + error);
            })
    })
</script>
</body>
</html>
