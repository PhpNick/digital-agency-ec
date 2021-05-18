import BooksList from './components/BooksList.vue';
import AddBook from './components/AddBook.vue';
import EditBook from './components/EditBook.vue';
 
export const routes = [
    {
        name: 'index',
        path: '/',
        component: BooksList
    },
    {
        name: 'add',
        path: '/add',
        component: AddBook
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditBook
    }    
];