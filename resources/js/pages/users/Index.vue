<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { CirclePlus, Pencil, Trash, Users } from 'lucide-vue-next'
import { Button } from "@/components/ui/button";


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: '/users',
    },
];

type User = {
  id: number;
  name: string;
  email: string;
  password?: string;
};

const form = useForm({});

const props = defineProps<{
  users: {
    data: User[];
  };
}>();

console.log(props.users)

function deleteItem(id: number) {
    form.delete(route('users.destroy', id),{
        preserveScroll: true
    })
}
</script>

<template>
    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex">
                <Button as-child size="sm" class="bg-indigo-600 text-white hover:bg-indigo-800">
                    <Link href="/users/create"> <CirclePlus/> Create</Link>
                 </Button>
            </div>

           <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar md:min-h-min ">

                <div class="rounded-xl overflow-hidden">
                    <table class="w-full text-sm text-gray-500 rounded-lg">
                        <thead class="text-xs text-gray-700 uppercase dark:bg-indigo-200 rounded-lg">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">name</th>
                                <th scope="col" class="px-6 py-3">email</th>
                                <th scope="col" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="dark:bg-gray-100">
                            <tr v-for="user in props.users.data" :key="user.id">
                                <th class="px-6 py-2 font-medium dark:text-gray-800">{{ user.id }}</th>
                                <th class="px-6 py-2 font-medium dark:text-gray-800">{{ user.name }}</th>
                                <th class="px-6 py-2 font-medium dark:text-gray-800">{{ user.email }}</th>
                                <th>
                                    <Button as-child size="sm" class="bg-blue-500 text-white hover:bg-blue-700">
                                        <Link :href="`users/${user.id}/edit`"><Pencil/></Link>
                                    </Button>

                                    <Button @click="deleteItem(user.id)" as-child size="sm" class="bg-rose-500 text-white hover:bg-rose-700">
                                        <Link href=""><Trash/></Link>
                                    </Button>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            
            
            
           </div>

        </div>
    </AppLayout>
</template>
