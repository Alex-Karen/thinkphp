import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'

// import UserList from '@/views/users/UserList'

Vue.use(Router)

export default new Router({
	routes: [
		{
			path: '/',
			name: 'HelloWorld',
			component: HelloWorld
		},
		{
			path: '/users',
			name: 'users',
			// component: UserList
			// component: function() {
			//   return import('@/views/users/UserList')
			// }
			component: () => import('@/views/users/UserList')
		},
		{
			path: '/grid',
			name: 'grid',
			component: () => import('@/views/vuetify/grid')
		},
		{
			path: '/users/add',
			name: 'addUser',
			component: () => import('@/views/users/UserAdd')
		},
		{
			path: '/users/edit/:id',
			name: 'editUser',
			component: () => import('@/views/users/UserEdit')
		},
		{
			path: '/demo',
			name: 'demo',
			component: () => import('@/views/test/demo')
		}
	]
})
