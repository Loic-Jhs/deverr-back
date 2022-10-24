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
        <h6 class="card-subtitle mb-2 text-muted">Par ici la monnaie <span style="font-size: 4rem">💶</span></h6>
        <p class="card-text">ID de la prestation réalisée : {{ $developerPrestation->prestation_id }}</p>
        <p>ID du développeur l'ayant réalisé : {{ $developerPrestation->developer_id }}</p>
        <p>Prix de la prestation : {{ $developerPrestation->price }}€</p>
        <form id="checkout-button" action="{{ route('preorder', [$developerPrestation->client_id, $developerPrestation->id]) }}" method="post">
            @csrf
            <button type="submit" class="btn btn-primary">Payer | {{ $developerPrestation->price }}€</button>
        </form>
        <input type="hidden" name="prestation_id" value="{{ $developerPrestation->id }}">
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
