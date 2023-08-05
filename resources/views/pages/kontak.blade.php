@extends('layouts.front')

@section('content')
<div class="bradcam_area bradcam_bg_4">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>Kontak</h3>
                    <p>{{ config('app.name') }} Kontak</p>
                </div>
            </div>
        </div>
    </div>
</div>


<section class="contact-section">
    <div class="container">
        <div class="d-none d-sm-block mb-5 pb-4">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1021077.9938637866!2d131.80750098804052!3d-1.4241288846321445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d5a8f3db5fbb123%3A0x21654c126db10d9e!2sMaybrat%20Regency%2C%20West%20Papua!5e0!3m2!1sen!2sid!4v1644505495032!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="row">
            <div class="col-12">
                <h2 class="contact-title">Kontak Kami</h2>
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $item)
                        <div class="alert alert-danger" role="alert">
                            {{ $item }}
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-lg-8">
                <form class="form-contact contact_form" action="{{ route('contact_form.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Pesan'" placeholder=" Pesan"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nama'" placeholder="Nama">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Subjek'" placeholder="Subjek">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 offset-lg-1">
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-home"></i></span>
                    <div class="media-body">
                        <h3>{{ env('APP_NAME') }}.</h3>
                        <p>{{ env('APP_NAME') }}</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                    <div class="media-body">
                        <h3>+62 852-5562-5733</h3>
                        <p>Senin - Sabtu</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-email"></i></span>
                    <div class="media-body">
                        <h3><a href="javascript:void(0)" class="__cf_email__">webwisata@gmail.com</a></h3>
                        <p>Kirim email kepada kami kapan saja</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
