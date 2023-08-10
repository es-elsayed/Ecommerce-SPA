<script setup>
import NavLink from '@/admin/Components/Nav/NavLink.vue';
import Dropdown from '@/admin/Components/Dropdown.vue';
import DropdownLink from '@/admin/Components/DropdownLink.vue';
import DropdownButton from '@/admin/Components/DropdownButton.vue';

</script>
<template>
    <!-- Navigation Links -->
    <div class="items-center hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <div v-for="menu in $page.props.menus" v-show="menu.isVisible">
            <NavLink v-if="typeof menu.url  === 'string'" :href="menu.url" :active="menu.isActive">
                {{ menu.label }}
            </NavLink>

            <!-- Settings Dropdown -->
            <Dropdown v-else align="right" width="48">
                <template #trigger>
                    <DropdownButton :active="menu.isActive" :label="menu.label" />
                </template>

                <template #content>
                    <DropdownLink v-show="men.isVisible" :active="men.isActive" :href="men.url" v-for="men in menu.url"> {{
                        men.label }} </DropdownLink>
                </template>
            </Dropdown>
        </div>
    </div>
</template>
