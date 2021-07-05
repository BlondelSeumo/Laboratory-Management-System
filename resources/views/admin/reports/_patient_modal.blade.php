
<!-- Modal patient information -->
<div class="modal fade" id="patient_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Patient info') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="p-0 list-style-none">
                    <li>
                        <h6>
                            <b>{{__('Name')}} : </b> {{$group['patient']['name']}}
                        </h6>
                    </li>
                    <li>
                        <h6>
                            <b>{{__('Gender')}} : </b> {{__($group['patient']['gender'])}}
                        </h6>
                    </li>
                    <li>
                        <h6>
                            <b>{{__('DOB')}} : </b> {{$group['patient']['dob']}}
                        </h6>
                    </li>
                    <li>
                        <h6>
                            <b>{{__('Age')}} : </b> {{$group['patient']['age']}}
                        </h6>
                    </li>
                    <li>
                        <h6>
                            <b>{{__('Phone')}} : </b> {{$group['patient']['phone']}}
                        </h6>
                    </li>
                    <li>
                        <h6>
                            <b>{{__('Email')}} : </b> {{$group['patient']['email']}}
                        </h6>
                    </li>
                    <li>
                        <h6>
                            <b>{{__('Address')}} : </b> {{$group['patient']['address']}}
                        </h6>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- \Modal patient information -->
