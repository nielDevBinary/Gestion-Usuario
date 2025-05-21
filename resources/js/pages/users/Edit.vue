<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from "@/components/ui/button";
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import InputError from '@/components/InputError.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Edit User',
        href: '/posts/create',
    },
];

type User = {
  id: number;
  name: string;
  email: string;
};

const props = defineProps<{
  user: User;
}>();


const form = useForm({
    name: props.user.name,
    email: props.user.email,
})

const submit = () => {
    form.put(route('users.update', props.user.id), {
        preserveScroll: true,
        onSuccess: () => form.reset()
    });
}


</script>

<template>

    <Head title="Edit User" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex">
                <Button as-child size="sm" class="bg-indigo-600 text-white hover:bg-indigo-800">
                    <Link href="/users"> Back</Link>
                </Button>
            </div>

            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar md:min-h-min p-6">

                <form @submit.prevent="submit" class="space-y-6 max-w-lg">
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input id="name" class="mt-1 block w-full"  placeholder="Full name" v-model="form.name"/>
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="email">Email address</Label>
                        <Input id="email" type="email" class="mt-1 block w-full"  placeholder="Email address" v-model="form.email"/>
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <!-- <div class="grid gap-2">
                        <Label for="password">Password</Label>
                        <Input id="password" type="password" class="mt-1 block w-full" 
                            placeholder="Passwors" v-model="form.password"/>
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div> -->
                    
                    <Button type="submit" class="mt-2 w-full dark:bg-amber-500 dark:hover:bg-amber-700">
                        Create account
                    </Button>

                </form>

            </div>


        </div>
    </AppLayout>
</template>
