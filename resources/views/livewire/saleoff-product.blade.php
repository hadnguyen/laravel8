<div>
    <div class="product__discount">
        <div class="section-title product__discount__title">
            <h2>Sale Off</h2>
        </div>
        <div class="row">
            <div class="product__discount__slider owl-carousel">
                @foreach ($products as $product)
                    <div class="col-lg-4">
                        <div class="product__discount__item">
                            <div class="product__discount__item__pic set-bg"
                                data-setbg="{{ url('uploads') }}/{{ $product->anh }}">
                                <div class="product__discount__percent">
                                    -{{ number_format((($product->gia - $product->giaban) * 100) / $product->gia) }}%</div>
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__discount__item__text">
                                <span>{{ $product->nhomsanpham()->ten }}</span>
                                <h5><a href="#">{{ $product->ten }}</a></h5>
                                <div class="product__item__price">{{ number_format($product->giaban, 0) }}
                                    <span>{{ number_format($product->gia, 0) }}</span></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
