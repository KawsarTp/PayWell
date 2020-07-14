                @if($errors->has('money'))
                  <div class="toast " role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                  <div class="toast-header bg-danger text-light">
                      <strong class="mr-auto">Warning</strong>
                      <small class="text-muted">just now</small>
                      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                    <div class="toast-body">
                        {{$errors->first('money')}}
                    </div>
                  </div>
                  @endif

                  @if(session()->has('error'))
                  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                    <div class="toast-header bg-danger text-light">
                    <strong class="mr-auto">Warning</strong>
                    <small class="text-muted">just now</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                  <div class="toast-body">
                    {{session('error')}}
                  </div>
                </div>
                  @endif

                  @if(session()->has('short'))
                  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                    <div class="toast-header">
                        <strong class="mr-auto">Warning</strong>
                        <small class="text-muted">just now</small>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                    {{$errors->first('short')}}
                    </div>
                    </div>
                  @endif

                  @if($errors->has('username'))
                  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                    <div class="toast-header bg-danger text-light">
                        <strong class="mr-auto">Warning</strong>
                        <small class="text-muted">just now</small>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                    {{$errors->first('username')}}
                    </div>
                    </div>
                  @endif


            @if($errors->has('email'))
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
              <div class="toast-header">
                  <strong class="mr-auto">Warning</strong>
                  <small class="text-muted">just now</small>
                  <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="toast-body">
              {{$errors->first('email')}}
              </div>
              </div>
              @endif

              @if(session()->has('exists'))
              <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header">
                    <strong class="mr-auto">Warning</strong>
                    <small class="text-muted">just now</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                {{$errors->first('exists')}}
                </div>
                </div>
              @endif

              @if(session()->has('success'))
              <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header">
                    <strong class="mr-auto">Warning</strong>
                    <small class="text-muted">just now</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                {{$errors->first('success')}}
                </div>
                </div>
              @endif
