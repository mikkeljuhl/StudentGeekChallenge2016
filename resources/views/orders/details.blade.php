@extends('layouts.app')

@section("header")



@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Place Order</div>
                    <div class="panel-body">
                        @if(session()->get('message'))
                            <div class="alert alert-success alert-dismissable">{{ session()->get('message') }}</div>
                        @endif

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/orders/success') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">

                                    <input id="name" type="text" class="form-control" name="name"
                                           @if(old('name') != null) value="{{ old('name') }}"
                                           @elseif($user->name != null) value="{{ $user->name }}"
                                           @endif
                                           required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Phone</label>

                                <div class="col-md-6">

                                    <input id="phone" type="text" class="form-control" name="phone"
                                           @if(old('phone') != null) value="{{ old('phone') }}"
                                           @elseif($user->phone!= null) value="{{ $user->phone }}"
                                           @endif
                                           required autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('shipping_address') ? ' has-error' : '' }}">
                                <label for="shipping_address" class="col-md-4 control-label">Shipping address</label>

                                <div class="col-md-6">
                                    <input id="shipping_address" type="text" class="form-control"
                                           name="shipping_address"
                                           @if(old('shipping_address') != null) value="{{ old('shipping_address') }}"
                                           @elseif($user->shipping_address != null) value="{{ $user->shipping_address }}"
                                           @endif
                                           required>

                                    @if ($errors->has('shipping_address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('shipping_address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('shipping_postcode') ? ' has-error' : '' }}">
                                <label for="shipping_postcode" class="col-md-4 control-label">Shipping postcode</label>

                                <div class="col-md-6">
                                    <input id="shipping_postcode" type="text" class="form-control"
                                           name="shipping_postcode"
                                           @if(old('shipping_postcode') != null) value="{{ old('shipping_postcode') }}"
                                           @elseif($user->shipping_postcode != null) value="{{ $user->shipping_postcode }}"
                                           @endif
                                           required>

                                    @if ($errors->has('shipping_postcode'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('shipping_postcode') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('shipping_city') ? ' has-error' : '' }}">
                                <label for="shipping_city" class="col-md-4 control-label">Shipping city</label>

                                <div class="col-md-6">
                                    <input id="shipping_city" type="text" class="form-control" name="shipping_city"
                                           @if(old('shipping_city') != null) value="{{ old('shipping_city') }}"
                                           @elseif($user->shipping_city != null) value="{{ $user->shipping_city }}"
                                           @endif
                                           required>

                                    @if ($errors->has('shipping_city'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('shipping_city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('shipping_country') ? ' has-error' : '' }}">
                                <label for="shipping_country" class="col-md-4 control-label">Shipping country</label>

                                <div class="col-md-6">
                                    <input id="shipping_country" type="text" class="form-control"
                                           name="shipping_country"
                                           @if(old('shipping_country') != null) value="{{ old('shipping_country') }}"
                                           @elseif($user->shipping_country != null) value="{{ $user->shipping_country }}"
                                           @endif
                                           required>

                                    @if ($errors->has('shipping_country'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('shipping_country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('billing_address') ? ' has-error' : '' }}">
                                <label for="billing_address" class="col-md-4 control-label">Billing address</label>

                                <div class="col-md-6">
                                    <input id="billing_address" type="text" class="form-control" name="billing_address"
                                           @if(old('billing_address') != null) value="{{ old('billing_address') }}"
                                           @elseif($user->billing_address != null) value="{{ $user->billing_address }}"
                                           @endif
                                           required>

                                    @if ($errors->has('billing_address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('billing_address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('billing_postcode') ? ' has-error' : '' }}">
                                <label for="billing_postcode" class="col-md-4 control-label">billing postcode</label>

                                <div class="col-md-6">
                                    <input id="billing_postcode" type="text" class="form-control"
                                           name="billing_postcode"
                                           @if(old('billing_postcode') != null) value="{{ old('billing_postcode') }}"
                                           @elseif($user->billing_postcode != null) value="{{ $user->billing_postcode }}"
                                           @endif
                                           required>

                                    @if ($errors->has('billing_postcode'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('billing_postcode') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('billing_city') ? ' has-error' : '' }}">
                                <label for="billing_city" class="col-md-4 control-label">billing city</label>

                                <div class="col-md-6">
                                    <input id="billing_city" type="text" class="form-control" name="billing_city"
                                           @if(old('billing_city') != null) value="{{ old('billing_city') }}"
                                           @elseif($user->billing_city != null) value="{{ $user->billing_city }}"
                                           @endif
                                           required>

                                    @if ($errors->has('billing_city'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('billing_city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('billing_country') ? ' has-error' : '' }}">
                                <label for="billing_country" class="col-md-4 control-label">billing country</label>

                                <div class="col-md-6">
                                    <input id="billing_country" type="text" class="form-control" name="billing_country"
                                           @if(old('billing_country') != null) value="{{ old('billing_country') }}"
                                           @elseif($user->billing_country != null) value="{{ $user->billing_country }}"
                                           @endif
                                           required>

                                    @if ($errors->has('billing_country'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('billing_country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <fieldset>
                                <legend>Invoice lines</legend>

                            <table class="table-striped" style="width:100%;">
                                <thead>
                                <th>Title</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th></th>
                                <th></th>
                                <th></th>

                                </thead>
                                @foreach($basket_items as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->price }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Subtotal:</strong></td>
                                    <td>{{ $subtotal  }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Tax:</strong></td>
                                    <td>{{ $tax }}</td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total (excl. shipping):</strong></td>
                                    <td>{{ $subtotal + $tax }}</td>
                                </tr>
                            </table>

                            <div style="margin-top:20px;" class="form-group{{ $errors->has('shipping_method') ? ' has-error' : '' }}">
                                <label for="shipping_method" class="col-md-4 control-label">Shipping Method</label>
                                <div class="col-sm-6">
                                    <select name="shipping_method" id="shipping_method" class="form-control">
                                        @foreach($shipping_methods as $method)
                                            <option value="{{ $method->id }}">{{ $method->title }} {{ $method->price }}
                                                ,-
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                                </fieldset>

                            <fieldset>
                                <legend>Dummy Payment -- is not required</legend>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-holder-name">Name on Card</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="card-holder-name"
                                               id="card-holder-name" placeholder="Card Holder's Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-number">Card Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="card-number" id="card-number"
                                               placeholder="Debit/Credit Card Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="expiry-month">Expiration Date</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <select class="form-control col-sm-2" name="expiry-month"
                                                        id="expiry-month">
                                                    <option>Month</option>
                                                    <option value="01">Jan (01)</option>
                                                    <option value="02">Feb (02)</option>
                                                    <option value="03">Mar (03)</option>
                                                    <option value="04">Apr (04)</option>
                                                    <option value="05">May (05)</option>
                                                    <option value="06">June (06)</option>
                                                    <option value="07">July (07)</option>
                                                    <option value="08">Aug (08)</option>
                                                    <option value="09">Sep (09)</option>
                                                    <option value="10">Oct (10)</option>
                                                    <option value="11">Nov (11)</option>
                                                    <option value="12">Dec (12)</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-3">
                                                <select class="form-control" name="expiry-year">
                                                    <option value="16">2016</option>
                                                    <option value="17">2017</option>
                                                    <option value="18">2018</option>
                                                    <option value="19">2019</option>
                                                    <option value="20">2020</option>
                                                    <option value="21">2021</option>
                                                    <option value="22">2022</option>
                                                    <option value="23">2023</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="cvv">Card CVV</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="cvv" id="cvv"
                                               placeholder="Security Code">
                                    </div>
                                </div>
                            </fieldset>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Pay now
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("footer")


@endsection
