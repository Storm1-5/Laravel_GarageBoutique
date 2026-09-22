<section id="cart">
    <h2>Votre panier</h2>
    @if (empty(session('cart')))
        <p>Votre panier est vide.</p>
    @else
        @php $total = 0; @endphp
        <ul>
            @foreach (session('cart') as $item)
                @php $total += $item['price'] * $item['quantity']; @endphp
                <li>{{ $item['name'] }} - {{ $item['quantity'] }} x {{ number_format($item['price'], 2, ',', ' ') }} €</li>
            @endforeach
        </ul>
        <p>Total : {{ number_format($total, 2, ',', ' ') }} €</p>
        <form method="POST" action="{{ route('cart.reset') }}">
            @csrf
            @method('DELETE')
            <button type="submit">Vider le panier</button>
        </form>
    @endif
</section>
