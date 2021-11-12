<template>
    <div>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Carrito de compras</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table v-if="cars !== ''" class="table table-responsive-lg table-hover">
                            <thead>
                            <tr>
                                <th class="col-sm-3"></th>
                                <th class="col-sm-3"></th>
                                <th class="col-sm-2">Cantidad</th>
                                <th class="col-sm-2">Precio unitario</th>
                                <th class="col-sm-2">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(car, index) in cars" :key="index">
                                <td>
                                    <img class="img-fluid" style="object-fit: contain" :src="car.image" alt="Auto">
                                </td>
                                <td>
                                    <span class="font-weight-bold" v-text="car.model"/>
                                </td>
                                <td>
                                    <div class="form-group row">
                                        <i @click="addItem(index, -1)" v-if="car.quantity >1" class="fas fa-minus-circle my-auto" style="cursor: pointer;"></i>
                                        <!--                                     <button class="btn btn-danger btn-sm">-->
                                        <!--                                         <i class="fas fa-plus"></i>-->
                                        <!--                                     </button>-->
                                        <span type="number" class="col-sm-1 mx-md-2 pl-1">{{ car.quantity }}</span>
                                        <i @click="addItem(index, 1)" class="fas fa-plus-circle my-auto" style="cursor: pointer;"></i>
                                        <i @click="deleteItem(index)" class="fas fa-trash my-auto text-danger ml-2" style="cursor: pointer;"></i>
                                    </div>
                                </td>
                                <td>
                                    <strong>${{ car.cart }}.00 USD</strong>
                                </td>
                                <td>
                                    <span :id="'sub'+index">{{getSub(index)}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <strong>Total: </strong>
                                </td>
                                <td><span>{{total}}</span></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="container text-center" v-else>
                            <img class="image-cart" src="/img/empty.png" alt="shoppingCart">
                            <h3 class="font-weight-bold">El carrito está vacío</h3>
                            <h5>(Recárga la página)</h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button @click="buy()" type="button" class="btn btn-primary">Realizar compra</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->


</template>

<script>

export default {
    name: "shoppingCart",
    props: {
      cart: Array
    },
    data() {
        return {
            cars: this.cart ?? '',
            total: 0,
            modal2: true,
        }
    },
    methods: {
        getSub(index) {
            let total = this.cars[index].quantity * this.cars[index].cart;
            $("#sub" + index).text(total);

            return total;
        },

        getCars() {
            const URL = `/cars/shoppingcart`;
            let me = this;
            axios.get(URL).then((res) => {
                let respuesta = res.data;
                me.cars = respuesta.cars;
                respuesta.cars.forEach(function (car, index, array) {
                    me.total = me.total + (Number(car.quantity) * Number(car.cart))
                })

            }).catch((err) => {
                console.log(err);
            })
            // this.getTotal();
        },
        buy(){
            Swal.fire(
                '¡Bien!',
                '¡Los autos ahora son tuyos!',
                'success'
            )
            this.cars = '';
            this.total = 0;

        },
        addItem(index, quantity) {
            this.cars[index].quantity += quantity;
            if (quantity > 0) {
                toastr.success('Ha sumado 1 pieza a su carrito');
            } else {
                toastr.error("Ha restado 1 pieza a su carrito");
            }

            this.getSub(index);
            let total = 0;
            this.cars.forEach(function (car) {
                total = total + (car.quantity * car.cart)
            })
            console.log(total);
            this.total = total;
        },
        deleteItem(index) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "El artículo se eliminará de tu carrito de compras",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.cars.splice(index, 1)
                    Swal.fire(
                        '¡Eliminado!',
                        '',
                        'success'
                    )
                    let total = 0;
                    this.cars.forEach(function (car) {
                        total = total + (car.quantity * car.cart)
                    })
                    console.log(total);
                    this.total = total;
                }
            })
        }
    },

}
</script>

<style scoped>
.image-cart {
    max-width: 50%;
    max-height: 50%;
    object-fit: contain;
}

.mostrar {
    display: list-item !important;
    opacity: 1 !important;
    /* position: absolute !important; */
    background-color: rgba(0, 0, 0, .4) !important;
}

#fixedbutton {
    position: fixed;
    bottom: 15px;
    right: 0px;
}
</style>
