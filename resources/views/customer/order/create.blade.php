@extends('app')

@section('content')
    <h1>Novo pedido</h1>

    <button class="btn btn-default new-item-btn">Novo item</button><br>
    <br>

    @include('errors._form')

    {!! Form::open(['route'=> 'customer.order.store']) !!}

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <select name="items[0][product_id]" class="form-control">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}"
                                data-price="{{ $product->price }}">
                            {{ $product->name }} - R$ {{ $product->formatted_price }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                {!! Form::text('items[0][qtd]', 1, ['class'=>'form-control']) !!}
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="2" align="right">
                Total: <strong>R$ <span class="order-total">0,00</span></strong>
            </td>
        </tr>
        </tfoot>
    </table>

    <div class="form-group">
        {!! Form::label('coupon_code', 'Cupom:') !!}
        {!! Form::text('coupon_code', null, [ 'class' => 'form-control']) !!}
    </div>

    <div class="form-group text-right">
        {!! Form::submit('Criar pedido', [ 'class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection

@section('scripts')
    <script>
        $(function () {
            $(".new-item-btn").click(function () {
                var row = $("table tbody > tr:last");
                var newRow = row.clone();
                var length = $("table tbody > tr").length;

                newRow.find("td").each(function () {
                    var td = $(this);
                    var input = td.find("input,select");
                    var name = input.attr("name");

                    input.attr("name", name.replace((length - 1) + "", length + ""));
                    input.val(1);
                });

                newRow.insertAfter(row);

                calculateTotal();
            });

            $("body").on("change", "select", function () {
                calculateTotal();
            });

            $("body").on("keyup", "input", function () {
                calculateTotal();
            });

            calculateTotal();

            function calculateTotal() {
                var total = 0;
                var trLen = $("table tbody > tr").length;
                var tr = null;
                var price;
                var qtd;

                for (var i = 0; i < trLen; i++) {
                    tr = $("table tbody > tr").eq(i);

                    price = tr.find(":selected").data("price");
                    qtd = tr.find("input").val();

                    total += price * qtd;
                }

                $(".order-total").html(total.format(2, 3, '.', ','));
            }
        });

        Number.prototype.format = function (n, x, s, c) {
            var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')';
            var num = this.toFixed(Math.max(0, ~~n));

            return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
        };
    </script>
@endsection