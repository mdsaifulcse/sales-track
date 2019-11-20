<!-- Modal -->
<div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Activate your account</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
                @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif
          <h5>Enter your valid email: </h5>
            
            <div class="input-group">
                <input type="email" name="email" placeholder="Email here ..." class="form-control" required>
                    <span class="input-group-btn">
                    <button id="update-email" type="button" class="btn btn-primary btn-flat">Send</button>
                    </span>
            </div>
            <p id="error" class="text-danger"></p>
            <br>
            @if(Auth::user()->email!='')
            <p class="text-center" style="font-size:11px; font-style:italic"> Note: If you do not find the account actvation email in your email account inbox then please check spam/junk. <br> In case of undelivered email & found no where then click <a class="" href="">RESEND</a> to get new email. </p>
            @endif
            <br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            @if(Auth::user()->email!='') <a class="btn btn-danger pull-right" id="resend" href="">Resend</a>@endif
        </div>
        </div>
    </div>
</div>


