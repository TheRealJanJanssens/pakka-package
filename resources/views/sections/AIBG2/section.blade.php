<section class="switchable imagebg {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="background-image-holder"> <img alt="background" {{ parseImage($section['AI2BG_BIMG'], $section['AI2BG_BIMG']['images'][0], 2500) }}> </div>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-6 adaptable__text">
                <ul class="accordion accordion-2 {{ parseSecAttr('.accordion', $section['classes']) }}">
                    <li class="active">
                        <div class="accordion__title"> <span class="h5">{{ parseContent($section['AI2BG_C1'],'title') }}</span> </div>
                        <div class="accordion__content">
                            <p class="lead">{{ parseContent($section['AI2BG_C1'],'text') }}</p>
                        </div>
                    </li>
                    <li>
                        <div class="accordion__title"> <span class="h5">{{ parseContent($section['AI2BG_C2'],'title') }}</span> </div>
                        <div class="accordion__content">
                            <p class="lead">{{ parseContent($section['AI2BG_C2'],'text') }}</p>
                        </div>
                    </li>
                    <li>
                        <div class="accordion__title"> <span class="h5">{{ parseContent($section['AI2BG_C3'],'title') }}</span> </div>
                        <div class="accordion__content">
                            <p class="lead">{{ parseContent($section['AI2BG_C3'],'text') }}</p>
                        </div>
                    </li>
                </ul>
            </div>
            
            <div class="col-lg-5 col-md-6">
	            
	            @if(!empty($section['AI2BG_IMG']['images']) && count($section['AI2BG_IMG']['images']) > 1)
	            	<div class="slider box-shadow-wide border--round" {{ parseSecAttr('.slider', $section['attributes']) }}>
                        @foreach($section['AI2BG_IMG']['images'] as $image)
							<div><img alt="img" {{ parseImage($section['AI2BG_IMG'], $image, 500) }}></div>
                        @endforeach 
                    </div>
	            @else
	            	<img alt="Image" class="border--round box-shadow-wide" {{ parseImage($section['AI2BG_IMG'], $section['AI2BG_IMG']['images'][0], 500) }}>
	            @endif
	             
	        </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>