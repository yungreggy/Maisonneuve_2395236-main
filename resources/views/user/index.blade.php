@extends('layouts.app')

@section('title', 'Étudiants')

@section('content')
<div class="row justify-content-center">
    <h1 class="mt-5 mb-4"><?php echo __('all.liste_administrateurs'); ?></h1>
</div>

<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"><?php echo __('ID'); ?></th>
                            <th scope="col"><?php echo __('all.nom'); ?></th>
                            <th scope="col"><?php echo __('all.actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                            <?php if($user->is_admin): ?>
                                <tr>
                                    <th scope="row"><?php echo $user->id; ?></th>
                                    <td><a href="<?php echo route('users.show', $user->id); ?>"><?php echo $user->name; ?></a></td>
                                    <td>
                                        <a href="<?php echo route('users.edit', $user->id); ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo route('users.destroy', $user->id); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('<?php echo __('Êtes-vous sûr de vouloir supprimer cet utilisateur ?'); ?>');">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo $users->links(); ?>
            </div>
        </div>
    </div>
</div>
@endsection



