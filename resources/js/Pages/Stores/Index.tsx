import { PageProps } from "@/types";
import { Store } from "@/models/Store";
import { AuthenticatedLayout } from "@/Layouts/Authenticated";
import { Head } from "@/Components/Head";
import { THeadProps, Table } from "@/Components/Table";
import { router } from "@inertiajs/react";

const storeHeader: THeadProps<Store>[] = [
    {
        key: 'name',
        title: 'Nome'
    },
    {
        key: 'store_number',
        title: 'Número'
    },
    {
        key: 'logo_url',
        title: 'logo',
        render: (data) => <img src={data.logo_url} title={data.name} />
    },
    {
        key: 'email',
        title: 'E-mail'
    },
    {
        key: 'phone',
        title: 'Telefone'
    },
    {
        key: 'whatsapp',
        title: 'Whatsapp'
    }
]

export default function StoresPage({stores, auth}: PageProps<{ stores: Store[] }>) {
    const handleDelete = (item: Store) => {
        console.log(item.id);
        router.delete(route('stores.delete', { id: item.id }), {
            preserveScroll: true,
            onBefore: () => confirm('Deseja excluir?'),
            onSuccess: () => {
                console.log('excluído com sucesso')
            }
        })
    }

    return <AuthenticatedLayout>
        <Head title="Lojas"></Head>
        <Table data={stores} headers={storeHeader} onDelete={(item) => handleDelete(item)} />
    </AuthenticatedLayout>;
}
