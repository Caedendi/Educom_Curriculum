import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './components/pages/home/home.component';
import { SlideshowComponent } from './components/pages/slideshow/slideshow.component';
import { ApiResultsComponent } from './components/pages/api-results/api-results.component';
import { TextEditorComponent } from './components/text-editor/text-editor.component';
import { TestComponent } from './components/pages/test/test.component';
import { LoginComponent } from './components/pages/login/login.component';
import { RegisterComponent } from './components/pages/register/register.component';
import { ProfileComponent } from './components/pages/profile/profile.component';
import { ApplicationsComponent } from './components/pages/applications/applications.component';
import { JobsComponent } from './components/pages/jobs/jobs.component';
import { DetailsComponent } from './components/pages/details/details.component';


const routes: Routes = [
  { path: '', redirectTo: '/home', pathMatch: 'full' },
  { path: 'home', component: HomeComponent },
  { path: 'register', component: RegisterComponent },
  { path: 'login', component: LoginComponent },
  { path: 'profile', component: ProfileComponent },
  { path: 'applications', component: ApplicationsComponent },
  { path: 'jobs', component: JobsComponent },
  { path: 'jobs/details/:id', component: DetailsComponent },

  { path: 'slideshow', component: SlideshowComponent },
  { path: 'api-results', component: ApiResultsComponent },
  { path: 'text', component: TextEditorComponent },
  { path: 'test', component: TestComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
