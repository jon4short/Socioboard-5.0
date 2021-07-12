<div class="card card-custom gutter-b card-stretch">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title font-weight-bolder">Preview</h3>
        <ul class="nav nav-light-warning nav-pills" id="preview-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="desktop-preview" data-toggle="tab" href="#desktop-preview" role="tab"
                   aria-controls="desktop-preview">Desktop</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="mobile-preview" data-toggle="tab" href="#mobile-preview" role="tab"
                   aria-controls="mobile-preview">Mobile</a>
            </li>

        </ul>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-2 position-relative overflow-hidden">
        <div id="draft_Schedule_id">
            @if(isset($socialAccounts) && !empty($socialAccounts))
            <ul class="nav nav-light-warning nav-pills" id="social-preview-tabs" role="tablist">


                @if(isset($isFacebook) &&  isset($isTwitter) && ($isFacebook === "true") && ($isTwitter === "true") && ($isLinkedin === "true"))
                    <li class="nav-item">
                        <a class="nav-link active" id="twitter-tab-preview" data-toggle="tab" href="#twitter-preview"
                           aria-controls="Twitter">
                            <span class="nav-text">Twitter</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="facebook-tab-preview" data-toggle="tab" href="#facebook-preview">
                            <span class="nav-text">Facebook</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="linkedin-tab-preview" data-toggle="tab" href="#linkedin-preview">
                            <span class="nav-text">Linkedin</span>
                        </a>
                    </li>
                @elseif(isset($isTwitter) && ($isTwitter === "true") && ($isFacebook === "false") && ($isLinkedin === "false"))
                    <li class="nav-item">
                        <a class="nav-link active" id="twitter-tab-preview" data-toggle="tab" href="#twitter-preview"
                           aria-controls="Twitter">
                            <span class="nav-text">Twitter</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="facebook-tab-preview" title="please select Facebook account to enable the Preview">
                            <span class="nav-text">Facebook</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="linkedin-tab-preview" title="please select Linked in account to enable the Preview">
                            <span class="nav-text">Linkedin</span>
                        </a>
                    </li>
                @elseif(isset($isFacebook) &&  ($isFacebook === "true") && ($isTwitter === "false") && ($isLinkedin === "false"))
                    <li class="nav-item">
                        <a class="nav-link" id="twitter-tab-preview" aria-controls="Twitter" title="please select Twitter account to enable the Preview">
                            <span class="nav-text">Twitter</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="facebook-tab-preview" data-toggle="tab" href="#facebook-preview">
                            <span class="nav-text">Facebook</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="linkedin-tab-preview" title="please select Linked in account to enable the Preview">
                            <span class="nav-text">Linkedin</span>
                        </a>
                    </li>
                @elseif(($isFacebook === "false") && ($isTwitter === "false") && isset($isLinkedin ) && ($isLinkedin === "false"))
                    <li class="nav-item">
                        <a class="nav-link" id="twitter-tab-preview" aria-controls="Twitter" title="please select any account to enable the Preview">
                            <span class="nav-text">Twitter</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="facebook-tab-preview" title="please select any account to enable the Preview">
                            <span class="nav-text">Facebook</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="linkedin-tab-preview" title="please select any account to enable the Preview">
                            <span class="nav-text">Linkedin</span>
                        </a>
                    </li>
                @elseif(isset($isLinkedin) &&  ($isLinkedin === "true") && ($isTwitter === "false") && ($isFacebook === "false"))
                    <li class="nav-item">
                        <a class="nav-link" id="twitter-tab-preview" aria-controls="Twitter" title="please select Twitter account to enable the Preview">
                            <span class="nav-text">Twitter</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="facebook-tab-preview" title="please select Facebook in account to enable the Preview">
                            <span class="nav-text">Facebook</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="linkedin-tab-preview" data-toggle="tab" href="#linkedin-preview">
                            <span class="nav-text">Linkedin</span>
                        </a>
                    </li>
                @elseif(isset($isLinkedin) && isset($isFacebook) &&  ($isLinkedin === "true") && ($isFacebook === "true") && ($isTwitter === "false"))
                    <li class="nav-item">
                        <a class="nav-link" id="twitter-tab-preview" aria-controls="Twitter" title="please select Twitter account to enable the Preview">
                            <span class="nav-text">Twitter</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="facebook-tab-preview" data-toggle="tab" href="#facebook-preview">
                            <span class="nav-text">Facebook</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="linkedin-tab-preview" data-toggle="tab" href="#linkedin-preview">
                            <span class="nav-text">Linkedin</span>
                        </a>
                    </li>
                @elseif(isset($isLinkedin) && isset($isTwitter) &&  ($isLinkedin === "true") && ($isTwitter === "true") && ($isFacebook === "false"))
                    <li class="nav-item">
                        <a class="nav-link active" id="twitter-tab-preview" data-toggle="tab" href="#twitter-preview"
                           aria-controls="Twitter">
                            <span class="nav-text">Twitter</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="facebook-tab-preview" title="please select Facebook in account to enable the Preview">
                            <span class="nav-text">Facebook</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="linkedin-tab-preview" data-toggle="tab" href="#linkedin-preview">
                            <span class="nav-text">Linkedin</span>
                        </a>
                    </li>
                @endif
            </ul>
            @endif
            <div class="tab-content mt-5" id="PreviewTabContent">
                @include('contentstudio::scheduling.components._preview_facebook')
                @include('contentstudio::scheduling.components._preview_instagram')
                @include('contentstudio::scheduling.components._preview_twitter')
                @include('contentstudio::scheduling.components._preview_linkedin')
            </div>
        </div>
    </div>
</div>
