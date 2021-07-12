import db from '../Sequelize-cli/models/index.js';
import CoreServices from '../../Common/Services/core.services.js';

const socialAccount = db.social_accounts;
const scheduleDetails = db.users_schedule_details;
const userTeamJoinTable = db.join_table_users_teams;
const teamSocialAccountJoinTable = db.join_table_teams_social_accounts;
const accountFeedsUpdateTable = db.social_account_feeds_updates;
const Operator = db.Sequelize.Op;
const teamInfo = db.team_informations;
const updateFriendsTable = db.social_account_friends_counts;
import moment from 'moment';

import pkg from 'sequelize';
const {Op, Sequelize} = pkg;
//const customHashtagModel = require('../mongoose/models/customHashTags');

const coreServices = new CoreServices();
const UserTeamAccount = {
  getSocialAccount(accountType, accountId, userId, teamId) {
    return new Promise(async (resolve, reject) => {
      try {
        await this.isTeamAccountValidForUser(userId, teamId, accountId);
        const accountDetails = await socialAccount.findOne({
          where: {
            account_type: accountType,
            account_id: accountId,
          },
        });
        if (!accountDetails) {
          accountType =
            accountType instanceof Array ? accountType[0] : accountType;
          var networkName = coreServices.getNetworkName(accountType);
          throw new Error(
            `No profile found or account isn't ${networkName.toLowerCase()} profile.`
          );
        } else resolve(accountDetails);
      } catch (error) {
        return reject(error);
      }
    });
  },

  isTeamValidForUser(userId, teamId) {
    return new Promise((resolve, reject) => {
      return userTeamJoinTable
        .findOne({
          where: {
            user_id: userId,
            team_id: teamId,
            left_from_team: false,
          },
          attributes: ['id', 'user_id'],
        })
        .then(result => {
          if (result) resolve();
          else throw new Error('User not belongs to the team!');
        })
        .catch(error => {
          reject(error);
        });
    });
  },

  isAccountValidForTeam(teamId, accountId) {
    return new Promise((resolve, reject) => {
      return teamSocialAccountJoinTable
        .findOne({
          where: {
            account_id: accountId,
            team_id: teamId,
            is_account_locked: 0,
          },
        })
        .then(result => {
          if (result) resolve();
          else
            throw new Error(
              "Account isn't belongs to team or account is locked for the team!"
            );
        })
        .catch(error => {
          reject(error);
        });
    });
  },

  isTeamAccountValidForUser(userId, teamId, accountId) {
    return new Promise(async (resolve, reject) => {
      try {
        await this.isTeamValidForUser(userId, teamId);
        await this.isAccountValidForTeam(teamId, accountId);
        return resolve();
      } catch (error) {
        reject(error);
      }
    });
  },

  createOrUpdateFriendsList(accountId, data) {
    return new Promise((resolve, reject) => {
      if (!accountId || !data) {
        reject(new Error('Please verify account id or data to update!'));
      } else {
        return updateFriendsTable
          .findOne({
            where: {account_id: accountId},
          })
          .then(result => {
            if (!result) {
              return updateFriendsTable.create({
                account_id: accountId,
                friendship_count:
                  data.friendship_count == undefined
                    ? null
                    : data.friendship_count,
                follower_count:
                  data.follower_count == undefined ? null : data.follower_count,
                following_count:
                  data.following_count == undefined
                    ? null
                    : data.following_count,
                page_count:
                  data.page_count == undefined ? null : data.page_count,
                group_count:
                  data.group_count == undefined ? null : data.group_count,
                board_count:
                  data.board_count == undefined ? null : data.board_count,
                subscription_count:
                  data.subscription_count == undefined
                    ? null
                    : data.subscription_count,
                total_like_count:
                  data.total_like_count == undefined
                    ? null
                    : data.total_like_count,
                total_post_count:
                  data.total_post_count == undefined
                    ? null
                    : data.total_post_count,
                bio_text: data.bio_text ? data.bio_text : null,
                profile_picture: data.profile_picture
                  ? data.profile_picture
                  : null,
                cover_picture: data.cover_picture ? data.cover_picture : null,
                updated_at: moment.utc().format(),
              });
            } else
              return result.update({
                friendship_count:
                  data.friendship_count == undefined
                    ? null
                    : data.friendship_count,
                follower_count:
                  data.follower_count == undefined ? null : data.follower_count,
                following_count:
                  data.following_count == undefined
                    ? null
                    : data.following_count,
                page_count:
                  data.page_count == undefined ? null : data.page_count,
                group_count:
                  data.group_count == undefined ? null : data.group_count,
                board_count:
                  data.board_count == undefined ? null : data.board_count,
                subscription_count:
                  data.subscription_count == undefined
                    ? null
                    : data.subscription_count,
                total_like_count:
                  data.total_like_count == undefined
                    ? null
                    : data.total_like_count,
                total_post_count:
                  data.total_post_count == undefined
                    ? null
                    : data.total_post_count,
                bio_text: data.bio_text ? data.bio_text : null,
                profile_picture: data.profile_picture
                  ? data.profile_picture
                  : null,
                cover_picture: data.cover_picture ? data.cover_picture : null,
                updated_at: moment.utc().format(),
              });
          })
          .then(data => resolve(data))
          .catch(error => reject(error));
      }
    });
  },

  isNeedToFetchRecentPost(accountId, frequencyValue, frequencyFactor) {
    return new Promise((resolve, reject) => {
      if (!accountId || !frequencyValue || !frequencyFactor) {
        reject(new Error('Please verify account id valid or not!'));
      } else {
        return accountFeedsUpdateTable
          .findOne({
            where: {
              account_id: accountId,
            },
          })
          .then(result => {
            if (!result) resolve(true);
            else {
              var difference = moment
                .tz(new Date(), 'GMT')
                .diff(moment.tz(result.updated_at, 'GMT'), frequencyFactor);
              resolve(difference > frequencyValue);
            }
          })
          .catch(error => {
            reject(error);
          });
      }
    });
  },

  createOrEditLastUpdateTime(accountId, socialId) {
    return new Promise((resolve, reject) => {
      if (!accountId) {
        reject(new Error('Please verify account id!'));
      } else {
        return accountFeedsUpdateTable
          .findOne({
            where: {account_id: accountId},
          })
          .then(result => {
            if (!result) {
              return accountFeedsUpdateTable.create({
                account_id: accountId,
                social_id: socialId,
                updated_at: moment.utc().format(),
              });
            } else return result.update({updated_at: moment.utc().format()});
          })
          .then(() => resolve())
          .catch(error => reject(error));
      }
    });
  },
};
export default UserTeamAccount;
