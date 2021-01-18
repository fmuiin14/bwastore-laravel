@extends('layouts.app')

@section('title')
    Store Detail Page
@endsection

@section('content')

<!-- Page Content -->
<div class="page-content page-details">
    <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Product Details
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="store-gallery" id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" data-aos="zoom-in">
                    <transition name="slide-fade" mode="out-in">
                        <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" class="w-100 main-image"
                            alt="">
                    </transition>
                </div>
                <div class="col-lg-2">
                    <div class="row">
                        <div class="col-3 col-lg-12 mt-2 mt-lg-0" v-for="(photo, index) in photos" :key="photo.id"
                            data-aos="zoom-in" data-aos-delay="100">
                            <a href="#" @click="changeActive(index)">
                                <img :src="photo.url" class="w-100 thumbnail-image"
                                    :class="{ active: index == activePhoto }" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="store-details-container" data-aos="fade-up">
        <section class="store-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h1>Sofa Ternyaman</h1>
                        <div class="owner">
                            By Fathul Muiin
                        </div>
                        <div class="price">$1,409</div>
                    </div>

                    <div class="col-lg-2" data-aos="zoom-in">
                        <a href="#" class="btn btn-success px-4 text-white btn-block mb-3">
                            Add to cart
                        </a>
                    </div>

                </div>
            </div>
        </section>
        <section class="store-description">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit dolorem nesciunt
                            veritatis cum reprehenderit provident autem dolorum quasi rem? Reprehenderit,
                            accusantium corrupti itaque ut magnam odit dicta similique nemo, omnis cupiditate
                            laudantium eum repudiandae labore eligendi inventore ratione. Deleniti, quis
                            voluptates. Ducimus asperiores nisi qui odit provident quasi dicta aliquam sequi
                            rem, soluta ipsa eaque debitis facilis iusto incidunt officiis repudiandae at
                            necessitatibus tenetur accusantium quam neque quis! Rem, placeat!</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, quaerat! Fugit eius
                            commodi rem, adipisci officia, temporibus minus deleniti atque soluta recusandae
                            iure. Ullam sit illum, dolor autem consequuntur tempore quam quas eligendi, harum
                            neque sapiente? Sint vero molestiae necessitatibus tempore quos. Blanditiis eveniet
                            esse sequi quis iusto, quia laborum.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-review">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 mt-3 mb-3">
                        <h5>Costumer Review (3)</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <ul class="list-unstyled">
                            <li class="media">
                                <img src="/images/icon-testimonial-1.png" alt="icon" class="mr-3 rounded-circle">
                                <div class="media-body">
                                    <h5 class="mt-2 mb-1">Pevita Pearce</h5>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam minima nisi
                                    ipsa dolore autem voluptatibus fuga qui ratione accusamus quasi.
                                </div>
                            </li>
                            <li class="media">
                                <img src="/images/icon-testimonial-2.png" alt="icon" class="mr-3 rounded-circle">
                                <div class="media-body">
                                    <h5 class="mt-2 mb-1">Pevita Pearce</h5>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam minima nisi
                                    ipsa dolore autem voluptatibus fuga qui ratione accusamus quasi.
                                </div>
                            </li>
                            <li class="media">
                                <img src="/images/icon-testimonial-3.png" alt="icon" class="mr-3 rounded-circle">
                                <div class="media-body">
                                    <h5 class="mt-2 mb-1">Pevita Pearce</h5>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam minima nisi
                                    ipsa dolore autem voluptatibus fuga qui ratione accusamus quasi.
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var gallery = new Vue({
            el: "#gallery",
            mounted() {
                AOS.init();
            },
            data: {
                activePhoto: 1,
                photos: [{
                        id: 1,
                        url: "/images/product-details-1.jpg"
                    },
                    {
                        id: 2,
                        url: "/images/product-details-2.jpg"
                    },
                    {
                        id: 3,
                        url: "/images/product-details-3.jpg"
                    },
                    {
                        id: 4,
                        url: "/images/product-details-4.jpg"
                    },
                ],
            },
            methods: {
                changeActive(id) {
                    this.activePhoto = id;
                }
            }
        });
    </script>
@endpush