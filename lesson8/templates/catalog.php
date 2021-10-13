<?php

?>
<h2>Каталог</h2>
<!--<div><a href="/cart/">Корзина (<?=$countCartItems['count']?: "Корзина пуста"?>)</a></div>-->
<div><a href="/cart/">Корзина JS <span class="counter">(<?=$countCartItems['count']?: "Корзина пуста"?>)</span></a></div>
<div class="catalog_all">
    <?php foreach ($catalog as $product): ?>
        <div class="catalog_item">
            <form action="/catalog/add/" method="post">
                <div>
                    <input type="text" name="id" value="<?= $product['id'] ?>" hidden>
                    <a href="/product/?id=<?= $product['id'] ?>">
                        <h2><?= $product['name'] ?></h2>
                        <img src="/img/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" width="150"><br>
                        Цена: <?= $product['price'] ?> <br>
                        <br>
                        <!--<input type="submit" value="Купить">-->
                    </a>
                </div>
            </form>
        Like: <span id="like<?=$product['id'] ?>"><?=$product['likes'] ?></span>
            <button class="like" data-id="<?=$product['id']?>">like</button>
            <button class="buy" data-id="<?=$product['id']?>">Купить JS</button>
            <hr>
        </div>
    <?php endforeach;?>
</div>
<script>
    let buttonsBuy = document.querySelectorAll('.buy');
    buttonsBuy.forEach((elem)=>{
        elem.addEventListener('click',()=>{
            let id = elem.getAttribute('data-id');
            (async ()=>{
                const response = await fetch('/api/buy/?id=' + id);
                const answer = await response.json();
                let counters = document.querySelectorAll('.counter');
                counters.forEach((elem)=>{
                    elem.innerText = " (" + answer.counter + ")";
                })
                //document.getElementById('counter').innerText = " (" + answer.counter + ")";

            })();
        })
    })


    let buttonslike = document.querySelectorAll('.like');
    buttonslike.forEach((elem)=>{
        elem.addEventListener('click',()=>{
            let id = elem.getAttribute('data-id');
            (async ()=>{
                const response = await fetch('/api/addlike/?id=' + id);
                const answer = await response.json();
                document.getElementById('like' + id).innerText = answer.likes;
                console.log(answer.likes);
            })();
        })
    })

</script>