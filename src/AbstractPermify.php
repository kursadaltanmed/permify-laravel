<?php
/**
 * Created by PhpStorm.
 * User: tolgaozen
 * Date: 3/16/22
 * Time: 9:26 PM
 */

namespace Permify\PermifyLaravel;

use Permify\Client;
use Permify\Requests\Request;

// Policy
use Permify\Requests\CreatePolicy;
use Permify\Requests\DeletePolicy;
use Permify\Requests\ListPolicy;
use Permify\Requests\RemoveOptionsFromPolicy;
use Permify\Requests\AddOptionsToPolicy;
use Permify\Requests\ShowPolicy;

// Option
use Permify\Requests\ShowOption;
use Permify\Requests\RemoveRulesFromOption;
use Permify\Requests\AddRulesToOption;
use Permify\Requests\CreateOption;
use Permify\Requests\DeleteOption;
use Permify\Requests\ListOption;

// Rule
use Permify\Requests\CreateRule;
use Permify\Requests\DeleteRule;
use Permify\Requests\ListRule;
use Permify\Requests\ShowRule;

// User
use Permify\Requests\AddRolesToUser;
use Permify\Requests\ListUser;
use Permify\Requests\RemoveRolesFromUser;
use Permify\Requests\CreateUser;
use Permify\Requests\DeleteUser;
use Permify\Requests\IsAuthorized;
use Permify\Requests\UpdateUser;
use Permify\Requests\ShowUser;

// Group
use Permify\Requests\ShowGroup;
use Permify\Requests\CreateGroup;
use Permify\Requests\DeleteGroup;
use Permify\Requests\UpdateGroup;
use Permify\Requests\ListGroup;

// Role
use Permify\Requests\ShowRole;
use Permify\Requests\CreateRole;
use Permify\Requests\DeleteRole;
use Permify\Requests\ListRole;

// Resource
use Permify\Requests\ShowResource;
use Permify\Requests\UpdateResource;
use Permify\Requests\CreateResource;
use Permify\Requests\DeleteResource;
use Permify\Requests\ListResource;


abstract class AbstractPermify {

    /**
     * @var \Permify\Client
     */
    protected $client;

    /**
     * @var int
     */
    protected $timeout;

    /**
     * AbstractPermify constructor.
     *
     * @param string $workspace_id
     * @param string $private_token
     */
    public function __construct($workspace_id, $private_token)
    {
        $this->client = new Client($workspace_id, $private_token);
    }

    /**
     * Send request.
     *
     * @param \Permify\Requests\Request $request
     *
     * @return mixed
     */
    abstract public function call(Request $request);

    /**
     * Create User.
     *
     * @param string $group_id
     * @param array  $optional
     *
     * @return \Permify\Requests\CreateUser
     */
    public function CreateUser($group_id, $optional = array()){
        return $this->call(new CreateUser($group_id, $optional));
    }

    /**
     * Delete user.
     *
     * @param string $id
     *
     * @return \Permify\Requests\DeleteUser
     */
    public function DeleteUser($id){
        return $this->call(new DeleteUser($id));
    }

    /**
     * Is user authorized.
     *
     * @param string $policy_name
     * @param string $user_id
     * @param array $optional
     *
     * @return \Permify\Requests\IsAuthorized
     */
    public function IsAuthorized($policy_name, $user_id , $optional = array()){
        return $this->call(new IsAuthorized($policy_name, $user_id, $optional));
    }

    /**
     * List users.
     *
     * @param array $optional
     *
     * @return \Permify\Requests\ListUser
     */
    public function ListUser($optional = array()){
        return $this->call(new ListUser($optional));
    }

    /**
     * Get user.
     *
     * @param string $id
     *
     * @return \Permify\Requests\ShowUser
     */
    public function ShowUser($id){
        return $this->call(new ShowUser($id));
    }

    /**
     * Update user.
     *
     * @param string $id
     * @param array $optional
     *
     * @return \Permify\Requests\UpdateUser
     */
    public function UpdateUser($id, $optional = array()){
        return $this->call(new UpdateUser($id, $optional));
    }

    /**
     * Add Roles To User.
     *
     * @param string $user_id
     * @param array $role_names
     *
     * @return \Permify\Requests\AddRolesToUser
     */
    public function AddRolesToUser($user_id, $role_names = array()){
        return $this->call(new AddRolesToUser($user_id, $role_names));
    }

    /**
     * Remove Roles From User.
     *
     * @param string $user_id
     * @param array $role_names
     *
     * @return \Permify\Requests\RemoveRolesFromUser
     */
    public function RemoveRolesFromUser($user_id, $role_names = array()){
        return $this->call(new RemoveRolesFromUser($user_id, $role_names));
    }

    /**
     * Add new group to Permify.
     *
     * @param string $name
     * @param array $optional
     *
     * @return \Permify\Requests\CreateGroup
     */
    public function CreateGroup($name, $optional = array()){
        return $this->call(new CreateGroup($name, $optional));
    }

    /**
     * Delete group.
     *
     * @param string $id
     *
     * @return \Permify\Requests\DeleteGroup
     */
    public function DeleteGroup($id){
        return $this->call(new DeleteGroup($id));
    }

    /**
     * List groups.
     *
     * @param array $optional
     *
     * @return \Permify\Requests\ListGroup
     */
    public function ListGroup($optional = array()){
        return $this->call(new ListGroup($optional));
    }

    /**
     * Get group.
     *
     * @param string $id
     *
     * @return \Permify\Requests\ShowGroup
     */
    public function ShowGroup($id){
        return $this->call(new ShowGroup($id));
    }

    /**
     * Update group.
     *
     * @param string $id
     * @param array $optional
     *
     * @return \Permify\Requests\UpdateGroup
     */
    public function UpdateGroup($id, $optional = array()){
        return $this->call(new UpdateGroup($id, $optional));
    }

    /**
     * Add new role to Permify.
     *
     * @param string $name
     * @param string $group_id
     * @param array $optional
     *
     * @return \Permify\Requests\CreateRole
     */
    public function CreateRole($name, $group_id, $optional = array()){
        return $this->call(new CreateRole($name, $group_id, $optional));
    }

    /**
     * Delete role.
     *
     * @param string $group_id
     * @param string $name
     *
     * @return \Permify\Requests\DeleteRole
     */
    public function DeleteRole($group_id, $name){
        return $this->call(new DeleteRole($group_id, $name));
    }

    /**
     * List roles.
     *
     * @param string $group_id
     *
     * @return \Permify\Requests\ListRole
     */
    public function ListRole($group_id){
        return $this->call(new ListRole($group_id));
    }

    /**
     * Get role.
     *
     * @param string $name
     * @param string $group_id
     *
     * @return \Permify\Requests\ShowRole
     */
    public function ShowRole($name, $group_id){
        return $this->call(new ShowRole($name, $group_id));
    }

    /**
     * Create resource.
     *
     * @param string $group_id
     * @param string $type
     * @param array $optional
     *
     * @return \Permify\Requests\CreateResource
     */
    public function CreateResource($group_id, $type, $optional = array()){
        return $this->call(new CreateResource($group_id, $type, $optional));
    }

    /**
     * Delete resource.
     *
     * @param string $id
     * @param string $type
     *
     * @return \Permify\Requests\DeleteResource
     */
    public function DeleteResource($id, $type){
        return $this->call(new DeleteResource($id, $type));
    }

    /**
     * List resources.
     *
     * @param array $optional
     *
     * @return \Permify\Requests\ListResource
     */
    public function ListResource($optional = array()){
        return $this->call(new ListResource($optional));
    }

    /**
     * Get resource.
     *
     * @param string $id
     * @param string $type
     *
     * @return \Permify\Requests\ShowResource
     */
    public function ShowResource($id, $type){
        return $this->call(new ShowResource($id, $type));
    }

    /**
     * Update resource.
     *
     * @param string $id
     * @param string $type
     * @param array $optional
     *
     * @return \Permify\Requests\UpdateResource
     */
    public function UpdateResource($id, $type, $optional = array()){
        return $this->call(new UpdateResource($id, $type,$optional));
    }

    /**
     * Create rule.
     *
     * @param string $name
     * @param string $condition
     *
     * @return \Permify\Requests\CreateRule
     */
    public function CreateRule($name, $condition){
        return $this->call(new CreateRule($name, $condition));
    }

    /**
     * Delete rule.
     *
     * @param string $name
     *
     * @return \Permify\Requests\DeleteRule
     */
    public function DeleteRule($name){
        return $this->call(new DeleteRule($name));
    }

    /**
     * List rules.
     *
     * @param array $optional
     *
     * @return \Permify\Requests\ListRule
     */
    public function ListRule($optional = array()){
        return $this->call(new ListRule($optional));
    }

    /**
     * Get rule.
     *
     * @param string $name
     *
     * @return \Permify\Requests\ShowRule
     */
    public function ShowRule($name){
        return $this->call(new ShowRule($name));
    }

    /**
     * Create option.
     *
     * @param string $name
     * @param array $role_names
     *
     * @return \Permify\Requests\CreateOption
     */
    public function CreateOption($name, $role_names = array()){
        return $this->call(new CreateOption($name, $role_names));
    }

    /**
     * Delete option.
     *
     * @param string $name
     *
     * @return \Permify\Requests\DeleteOption
     */
    public function DeleteOption($name){
        return $this->call(new DeleteOption($name));
    }

    /**
     * List options.
     *
     * @param array $optional
     *
     * @return \Permify\Requests\ListOption
     */
    public function ListOption($optional = array()){
        return $this->call(new ListOption($optional));
    }

    /**
     * Get option.
     *
     * @param string $name
     *
     * @return \Permify\Requests\ShowOption
     */
    public function ShowOption($name){
        return $this->call(new ShowOption($name));
    }

    /**
     * Add Rules To Option.
     *
     * @param string $option_name
     * @param array $rule_names
     *
     * @return \Permify\Requests\AddRulesToOption
     */
    public function AddRulesToOption($option_name, $rule_names = array()){
        return $this->call(new AddRulesToOption($option_name, $rule_names));
    }

    /**
     * Remove Rules From Option.
     *
     * @param string $option_name
     * @param array $rule_names
     *
     * @return \Permify\Requests\RemoveRulesFromOption
     */
    public function RemoveRulesFromOption($option_name, $rule_names = array()){
        return $this->call(new RemoveRulesFromOption($option_name, $rule_names));
    }

    /**
     * Create policy.
     *
     * @param string $name
     * @param array $option_names
     *
     * @return \Permify\Requests\CreatePolicy
     */
    public function CreatePolicy($name, $option_names = array()){
        return $this->call(new CreatePolicy($name, $option_names));
    }

    /**
     * Delete policy.
     *
     * @param string $name
     *
     * @return \Permify\Requests\DeletePolicy
     */
    public function DeletePolicy($name){
        return $this->call(new DeletePolicy($name));
    }

    /**
     * List policies.
     *
     * @param array $optional
     *
     * @return \Permify\Requests\ListPolicy
     */
    public function ListPolicy($optional = array()){
        return $this->call(new ListPolicy($optional));
    }

    /**
     * Get policy.
     *
     * @param string $name
     *
     * @return \Permify\Requests\ShowPolicy
     */
    public function ShowPolicy($name){
        return $this->call(new ShowPolicy($name));
    }

    /**
     * Add Options To Policy.
     *
     * @param string $policy_name
     * @param array $option_names
     *
     * @return \Permify\Requests\AddOptionsToPolicy
     */
    public function AddOptionsToPolicy($policy_name, $option_names = array()){
        return $this->call(new AddOptionsToPolicy($policy_name, $option_names));
    }

    /**
     * Remove Options From Policy.
     *
     * @param string $policy_name
     * @param array $option_names
     *
     * @return \Permify\Requests\RemoveOptionsFromPolicy
     */
    public function RemoveOptionsFromPolicy($policy_name, $option_names = array()){
        return $this->call(new RemoveOptionsFromPolicy($policy_name, $option_names));
    }
}