@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <!-- ==================== Breadcumb Start Here ==================== -->
    <section class="breadcumb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcumb__wrapper">
                        <h2 class="breadcumb__title">{{$pageTitle}}</h2>
                        <ul class="breadcumb__list">
                            {{-- <li class="breadcumb__item"><a href="https://preview.wstacks.com/smmcrowd" class="breadcumb__link"> --}}
                            <li class="breadcumb__item"><a href="/" class="breadcumb__link">
                                    <i class="fas fa-home"></i> @lang('Home')</a> </li>
                            <li class="breadcumb__item">/</li>
                            <li class="breadcumb__item"> <span class="breadcumb__item-text"> {{$pageTitle}} </span> </li>
                        </ul>
                    </div>
                </div>
            </div>

            @include($activeTemplate . 'sections.search')
        </div>
    </section>
    <!-- ==================== Breadcumb End Here ==================== -->

    <!-- ==================== Hostel List Start Here ==================== -->
    <section class="hostel-list-area py-120">
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="row align-items-center mb-4">
                        <div class="col-md-8">
                            <div class="hostel-top">
                                <h3 class="title-two mb-1">@lang('All Hostel')</h3>
                                <p>@lang('Sorted by our organic, commission-free algorithm.') </p>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-4">
                        @forelse ($hostels as $item)
                            @if ($item->rooms->count() > 0)
                                <div class="col-xl-6">
                                    <div class="hostel-list-item">
                                        <div class="hostel-list-item__thumb">
                                            <a
                                                href="{{ route('hostel_list_details', [slug($item->name), $item->id]) . '?' . http_build_query(request()->query()) }}">
                                                <img src="{{ getImage(getFilePath('hostel') . '/'.  @$item->hostel_images[0]->path . 'thumb_' .@$item->hostel_images[0]->image, getFileSize('hostel')) }}"
                                                    alt="">
                                            </a>
                                            @if ($item->discount)
                                                <span class="offer-title">{{ __($item->discount) }}
                                                    @lang('% OFF')</span>
                                            @endif
                                        </div>
                                        <div class="hostel-list-item__bottom-wrap">
                                            <div class="hostel-list-item__title-wrap">
                                                <h3 class="title-two"><a
                                                        href="{{ route('hostel_list_details', [slug($item->name), $item->id]) . '?' . http_build_query(request()->query()) }}">{{ __(strLimit(@$item->name, 15)) }}</a>
                                                </h3>
                                                <div class="rating-wrap">
                                                    @if (($item->average_rating && $item->average_rating > 0) || ($item->review_count && $item->review_count > 0))
                                                        <div class="left">
                                                            <div class="icon">
                                                                <span class="rating">{{ @$item->average_rating }}</span>

                                                                <p>{{ @$item->review_count }} @lang('Rating')</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="right">
                                                        <div class="icon">
                                                            <i class="fas fa-map-marker"></i>
                                                            <p>{{ __(strLimit($item->address, 30)) }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hostel-list-item__amount">
                                                <div class="amount-item">
                                                    <p>@lang('Price From')</p>
                                                    <h5 class="amount-item-title">
                                                        {{ gs()->cur_sym }}{{ @$item->lowPrice() }}</h5>
                                                </div>
                                                <div class="amount-item">
                                                    <p>@lang('Price To')</p>
                                                    <h5 class="amount-item-title">
                                                        {{ gs()->cur_sym }}{{ @$item->highPrice() }}</h5>
                                                </div>

                                                <div class="amount-item wishlist-btn" data-hostel_id="{{ $item->id }}">
                                                    @if (auth()->check() && $item->wishlist->count() > 0)
                                                        <i class="fas fa-heart"></i>
                                                    @else
                                                        <i class="far fa-heart"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="hostel-list-item__bottom">
                                                @php
                                                    $iconCount = collect($item->icons)->count();
                                                @endphp
                                                <div class="left">
                                                    <ul>
                                                        @forelse (@$item->icons as $index=> $icon)
                                                            @if ($index % $iconCount == 0)
                                                                <li>@php echo $icon @endphp</li>
                                                            @elseif($index % $iconCount == 1)
                                                                <li>@php echo $icon @endphp</li>
                                                            @elseif($index % $iconCount == 2)
                                                                <li>@php echo $icon @endphp</li>
                                                            @elseif($index % $iconCount == 3)
                                                                <li><i class="fas fa-ellipsis-v"></i>
                                                                    <ul class="hover-item-icon">
                                                                        @foreach (collect($item->icons)->skip(3) as $icon)
                                                                            <li>@php echo $icon @endphp</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                    </ul>

                                                </div>
                                                <div class="right">
                                                    <a href="{{ route('hostel_list_details', [slug($item->name), $item->id]) . '?' . http_build_query(request()->query()) }}"
                                                        class="btn btn--base">@lang('Book Now')</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                        @endforelse
                    </div>
                    @if ($hostels->hasPages())
                        <div class="py-4">
                            {{ paginateLinks($hostels) }}
                        </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    @include('presets.default.sections.blog_details_sidebar')
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== Hostel List End Here ==================== -->
@endsection

@push('script')
    <script>
        $('.wishlist-btn').on('click', function(event) {
            var hostel_id = $(this).data('hostel_id');
            var icon = $(this).find("i");
            var auth = @json(auth()->check());
            if (!auth) {
                window.location.href = "{{ route('user.login') }}";
            }
            var url = "{{ route('user.wishlist') }}";
            var token = '{{ csrf_token() }}';
            var data = {
                hostel_id: hostel_id,
                _token: token
            }
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(response) {
                    if (response.wishlist == 0) //removed
                    {
                        var wishlistSub = $('.wishlist-count').text();
                        wishlistSub = parseInt(wishlistSub) - 1;
                        $('.wishlist-count').text(wishlistSub);
                        icon.removeClass("fas fa-heart").addClass("far fa-heart");
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });
                    } else if (response.wishlist == 1) //added
                    {
                        $('.wishlist-count').text();
                        var wishlistAdd = $('.wishlist-count').text();
                        wishlistAdd = parseInt(wishlistAdd) + 1;
                        $('.wishlist-count').text(wishlistAdd);

                        icon.removeClass("far fa-heart").addClass("fas fa-heart");
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });
                    }
                },
                error: function(data, status, error) {
                    $.each(data.responseJSON.errors, function(key,
                        item) {
                        Toast.fire({
                            icon: 'error',
                            title: item
                        })
                    });
                }
            });
        });
    </script>
@endpush
