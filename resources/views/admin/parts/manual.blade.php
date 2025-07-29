<form id="featuers_form" method="post" action="{{ route('dash.settings.feature.manual') }}">
    @csrf
    <input name="id" type="hidden" value="{{ @$manual->id }}">
<div class=" col-lg-2 col-md-6 col-12">
    <div class="form-check form-switch">
        <label class="form-check-label" for="flexSwitchCheckDefault">تريندات</label>
        <input name="trend" class="form-check-input features_btn" type="checkbox" role="switch"
            id="flexSwitchCheckDefault" {{ $manual->trend == 1 ? 'checked' : ' ' }}>
    </div>
</div>
<div class=" col-lg-2 col-md-6 col-12">
    <div class="form-check form-switch">
        <label class="form-check-label" for="flexSwitchCheckDefault">الاكثر مبيعا</label>
        <input name="best" class="form-check-input features_btn" type="checkbox" role="switch"
            id="flexSwitchCheckDefault"{{ $manual->best == 1 ? 'checked' : ' ' }}>
    </div>
</div>
<div class=" col-lg-2 col-md-6 col-12">
    <div class="form-check form-switch">
        <label class="form-check-label" for="flexSwitchCheckDefault">المبيعات</label>
        <input name="selles" class="form-check-input features_btn" type="checkbox" role="switch"
            id="flexSwitchCheckDefault">
    </div>
</div>
<div class=" col-lg-2 col-md-6 col-12">
    <div class="form-check form-switch">
        <label class="form-check-label" for="flexSwitchCheckDefault">الاسعار المنخفضة</label>
        <input name="low" class="form-check-input features_btn" type="checkbox" role="switch"
            id="flexSwitchCheckDefault">
    </div>
</div>
<div class=" col-lg-2 col-md-6 col-12">
    <div class="form-check form-switch">
        <label class="form-check-label" for="flexSwitchCheckDefault">الطراز</label>
        <input name="teraz" class="form-check-input  features_btn" type="checkbox" role="switch"
            id="flexSwitchCheckDefault">
    </div>
</div>
</form>
