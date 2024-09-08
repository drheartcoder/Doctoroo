<!-- Pricing Details Modal Start -->
<div id="discount_code_popup" class="modal addperson fade big-modal" tabindex="-1" data-replace="true" data-toggle="modal" data-dismiss="modal" style="display: none; max-width: 1000px; top: 20%;">
    <div class="model-wraper2">
        <div class="modal-content">
            <h4 class="center-align">Pricing Details</h4>
            <a class="modal-close closeicon">
                <i class="material-icons">close</i>
            </a>
        </div>
        <div class="modal-data scroll-div">
            <div class="pricescetion">
                <h3 class="ques">How much does it cost to see a doctor?</h3>
                <div class="row">
                    <div id="test1" class="col s12 padno">
                        <table class="bordered striped">
                            <thead>
                                <tr style="background: #22b14c;">
                                    <th class="center-align">Code</th>
                                    <th class="center-align">Percentage</th>
                                    <th class="center-align">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($discount_data))
                                @foreach($discount_data as $dis_data)
                                    <tr>
                                        <td class="center-align">{{ $dis_data['code'] }}</td>
                                        <td class="center-align">{{ $dis_data['percentage'].'%' }}</td>
                                        <td class="center-align">Apply</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons full-width-btn">Ok</a>
        </div>
    </div>
</div>
<!-- Pricing Details Modal End -->