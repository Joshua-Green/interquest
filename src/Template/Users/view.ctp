<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Social Accounts'), ['controller' => 'SocialAccounts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Social Account'), ['controller' => 'SocialAccounts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= h($user->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th><?= __('First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Token') ?></th>
            <td><?= h($user->token) ?></td>
        </tr>
        <tr>
            <th><?= __('Api Token') ?></th>
            <td><?= h($user->api_token) ?></td>
        </tr>
        <tr>
            <th><?= __('Role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th><?= __('Token Expires') ?></th>
            <td><?= h($user->token_expires) ?></td>
        </tr>
        <tr>
            <th><?= __('Activation Date') ?></th>
            <td><?= h($user->activation_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Tos Date') ?></th>
            <td><?= h($user->tos_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Active') ?></th>
            <td><?= $user->active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Is Superuser') ?></th>
            <td><?= $user->is_superuser ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Personas') ?></h4>
        <?php if (!empty($user->personas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Ork Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Long Name') ?></th>
                <th><?= __('Image') ?></th>
                <th><?= __('Vocation Id') ?></th>
                <th><?= __('Monster Id') ?></th>
                <th><?= __('Npc Id') ?></th>
                <th><?= __('Background Public') ?></th>
                <th><?= __('Background Private') ?></th>
                <th><?= __('Park Id') ?></th>
                <th><?= __('Territory Id') ?></th>
                <th><?= __('Gold') ?></th>
                <th><?= __('Iron') ?></th>
                <th><?= __('Timber') ?></th>
                <th><?= __('Stone') ?></th>
                <th><?= __('Grain') ?></th>
                <th><?= __('Action Id') ?></th>
                <th><?= __('Is Knight') ?></th>
                <th><?= __('Is Rebel') ?></th>
                <th><?= __('Is Monarch') ?></th>
                <th><?= __('Fiefs Assigned') ?></th>
                <th><?= __('Shattered') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Deceased') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->personas as $personas): ?>
            <tr>
                <td><?= h($personas->id) ?></td>
                <td><?= h($personas->ork_id) ?></td>
                <td><?= h($personas->user_id) ?></td>
                <td><?= h($personas->name) ?></td>
                <td><?= h($personas->long_name) ?></td>
                <td><?= h($personas->image) ?></td>
                <td><?= h($personas->vocation_id) ?></td>
                <td><?= h($personas->monster_id) ?></td>
                <td><?= h($personas->npc_id) ?></td>
                <td><?= h($personas->background_public) ?></td>
                <td><?= h($personas->background_private) ?></td>
                <td><?= h($personas->park_id) ?></td>
                <td><?= h($personas->territory_id) ?></td>
                <td><?= h($personas->gold) ?></td>
                <td><?= h($personas->iron) ?></td>
                <td><?= h($personas->timber) ?></td>
                <td><?= h($personas->stone) ?></td>
                <td><?= h($personas->grain) ?></td>
                <td><?= h($personas->action_id) ?></td>
                <td><?= h($personas->is_knight) ?></td>
                <td><?= h($personas->is_rebel) ?></td>
                <td><?= h($personas->is_monarch) ?></td>
                <td><?= h($personas->fiefs_assigned) ?></td>
                <td><?= h($personas->shattered) ?></td>
                <td><?= h($personas->created) ?></td>
                <td><?= h($personas->modified) ?></td>
                <td><?= h($personas->deceased) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Personas', 'action' => 'view', $personas->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Personas', 'action' => 'edit', $personas->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Personas', 'action' => 'delete', $personas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personas->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Social Accounts') ?></h4>
        <?php if (!empty($user->social_accounts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Provider') ?></th>
                <th><?= __('Username') ?></th>
                <th><?= __('Reference') ?></th>
                <th><?= __('Avatar') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Link') ?></th>
                <th><?= __('Token') ?></th>
                <th><?= __('Token Secret') ?></th>
                <th><?= __('Token Expires') ?></th>
                <th><?= __('Active') ?></th>
                <th><?= __('Data') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->social_accounts as $socialAccounts): ?>
            <tr>
                <td><?= h($socialAccounts->id) ?></td>
                <td><?= h($socialAccounts->user_id) ?></td>
                <td><?= h($socialAccounts->provider) ?></td>
                <td><?= h($socialAccounts->username) ?></td>
                <td><?= h($socialAccounts->reference) ?></td>
                <td><?= h($socialAccounts->avatar) ?></td>
                <td><?= h($socialAccounts->description) ?></td>
                <td><?= h($socialAccounts->link) ?></td>
                <td><?= h($socialAccounts->token) ?></td>
                <td><?= h($socialAccounts->token_secret) ?></td>
                <td><?= h($socialAccounts->token_expires) ?></td>
                <td><?= h($socialAccounts->active) ?></td>
                <td><?= h($socialAccounts->data) ?></td>
                <td><?= h($socialAccounts->created) ?></td>
                <td><?= h($socialAccounts->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SocialAccounts', 'action' => 'view', $socialAccounts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SocialAccounts', 'action' => 'edit', $socialAccounts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SocialAccounts', 'action' => 'delete', $socialAccounts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $socialAccounts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
