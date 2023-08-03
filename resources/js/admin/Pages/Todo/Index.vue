<script setup>
import { Head, useForm } from '@inertiajs/vue3';

import AuthenticatedLayout from '@/admin/Layouts/AuthenticatedLayout.vue';
import Container from '@/admin/Components/Container.vue';
import Modal from '@/admin/Components/Modal.vue';
import Card from '@/admin/Components/Card/Card.vue';
import Table from '@/admin/Components/Table/Table.vue';
import Actions from '@/admin/Components/Table/Actions.vue';
import Button from '@/admin/Components/Base/Button.vue';
import Td from '@/admin/Components/Table/Td.vue';
import BasicFilter from '@/admin/Components/BasicFilter.vue';
import useDeleteItem from '@/admin/Composable/useDeleteItem.js';
import useFilter from '@/admin/Composable/useFilter.js';

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    items: {
        type: Object,
        default: () => ({}),
    },
    headers: {
        type: Array,
        default: () => [],
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
    routeResourceName: {
        type: String,
        required: true,
    },
})


const form = useForm({});


const complete = (item) => {
    console.log(item, item.id);
    form.put(route(`admin.${props.routeResourceName}.complete`, item.id));
};

</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout :title="title">

        <template #actions>
            <Button color="black" :href="route(`admin.${routeResourceName}.create`)">Create</Button>
        </template>

        <Container>


            <Card class="mt-4">

                <Table :headers="headers" :items="items">
                    <template v-slot="{ item }">
                        <Td>
                            <input type="checkbox" name="completed_at" :checked="item.completed_at" @click="complete(item)">
                        </Td>
                        <Td>{{ item.title }}</Td>
                        <Td>{{ item.description }}</Td>
                        <Td>{{ item.created_at }}</Td>
                    </template>
                </Table>
            </Card>
        </Container>
    </AuthenticatedLayout>
</template>
