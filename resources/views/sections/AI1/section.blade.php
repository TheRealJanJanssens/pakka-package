<section class="switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-6 adaptable__text">
                <ul class="accordion accordion-1 {{ parseSecAttr('.accordion', $section['classes']) }}">
                    <li class="active">
                        <div class="accordion__title"> <span class="h5">{{ parseContent($section['AI1_C1'],'title') }}</span> </div>
                        <div class="accordion__content">
                            <p class="lead">{{ parseContent($section['AI1_C1'],'text') }}</p>
                        </div>
                    </li>
                    <li>
                        <div class="accordion__title"> <span class="h5">{{ parseContent($section['AI1_C2'],'title') }}</span> </div>
                        <div class="accordion__content">
                            <p class="lead">{{ parseContent($section['AI1_C2'],'text') }}</p>
                        </div>
                    </li>
                    <li>
                        <div class="accordion__title"> <span class="h5">{{ parseContent($section['AI1_C3'],'title') }}</span> </div>
                        <div class="accordion__content">
                            <p class="lead">{{ parseContent($section['AI1_C3'],'text') }}</p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="col-lg-5 col-md-6">
	            
	            @if(!empty($section['AI1_IMG']['images']) && count($section['AI1_IMG']['images']) > 1)
	            	<div class="slider box-shadow-wide border--round" {{ parseSecAttr('.slider', $section['attributes']) }}>
                        @foreach($section['AI1_IMG']['images'] as $image)
							<div><img alt="img" {{ parseImage($section['AI1_IMG'], $image, 500) }}></div>
                        @endforeach 
                    </div>
	            @else
	            	<img alt="Image" class="border--round box-shadow-wide" {{ parseImage($section['AI1_IMG'], $section['AI1_IMG']['images'][0], 500) }}>
	            @endif
	             
	        </div>
            
        </div>
    </div>
{!! constructDividers($section) !!}
</section>